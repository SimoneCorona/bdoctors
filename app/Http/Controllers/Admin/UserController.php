<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Specialty;
use App\Sponsorship;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Stringable;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::all();
        // $tags = Tag::all();
        // return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidate());
        $data = $request->all();
        $user = new User();
        $user->fill($data);
        $user->slug = $this->generateUserSlugFromName($user->name, $user->surname);
        $user->save();
        if (isset($data['specialties'])) {
            $user->specialties()->sync($data['specialties']);
        }
        return redirect()->route('admin.profile', ['user' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $user = User::find($id);
        $user = Auth::user();
        $messages = $user->message;
        $reviews = $user->review;
        $sponsorships = $user->sponsorship;

        return view('admin.users.show', compact('user', 'messages', 'reviews', 'sponsorships'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $logged_user = Auth::user();
        $user = User::findOrFail($logged_user->id);
        $messages = $user->message;
        $reviews = $user->review;
        $sponsorships = $user->sponsorship;
        $specialties = Specialty::all()->sortBy('specialty_name');
        return view('admin.users.edit', compact('user', 'messages', 'reviews', 'sponsorships', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $user = Auth::user();
        $request->validate($this->getValidate());
        $data = $request->all();
        $logged_user = Auth::user();
        $user = User::findOrFail($logged_user->id);
        // dd($data);
        // $user = User::findOrFail($data['user']); 
        //se la richiesta contiene l'immagine
        if (isset($data['photo'])) {
            //  E se l'utente ha già una sua immagine
            if ($user->photo) {
                //cancelliamo l'immagine esistente
                Storage::delete($user->photo);
            }
            //  E salviamo comunque l'immagine nuova
            $image_path = Storage::put('profile_pics', $data['photo']);
            //  Salviamo il relativo path nel database
            $data['photo'] = $image_path;
        }
        $user->slug = $this->generateUserSlugFromName($user->name, $user->surname);
        $user->update($data);
        // dd($user);
        if (isset($data['specialties'])) {
            $user->specialties()->sync($data['specialties']);
        } else {
            $user->specialties()->sync([]);
        }
        return redirect()->route('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $logged_user = Auth::user();
        $user = User::findOrFail($logged_user->id);
        // dd($user);
        if ($user->photo) {
            Storage::delete($user->photo);
        }
        $user->specialties()->sync([]);
        $user->delete();
        return redirect()->route('login');
    }

    /**
     * Display the sponsorship selection page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sponsor()
    {
        $logged_user = Auth::user();
        $user = User::with(['sponsorships'])->where('id', '=', $logged_user->id)->first();
        $final_sponsorship = $user->sponsorships()
        ->wherePivot('date_end', '>', now())
        ->orderByDesc('pivot_date_end')
        ->first();

        if ($final_sponsorship) {
            $final_sponsorship_end = Carbon::parse($final_sponsorship->pivot->date_end);
        }
        else {
            $final_sponsorship_end = '';
        }

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $clientToken = $gateway->clientToken()->generate();
        return view('admin.users.sponsor', compact('user', 'final_sponsorship_end', 'clientToken'));
    }

    public function pay(Request $request)
    {
        $logged_user = Auth::user();
        $user = User::with(['sponsorships'])->where('id', '=', $logged_user->id)->first();

        $dati = $request->all();
        switch ($dati['tier']) {
            case 'bronzo':
                $amount = 2.99;
                break;
            case 'argento':
                $amount = 6.99;
                break;
            case 'oro':
                $amount = 9.99;
                break;

            default:
                $error = 'Piano non valido';
                return view('admin.users.payment-error', compact('error'));
                break;
        }

        // return dd($dati);
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            // 'amount' => '2000.99',
            'paymentMethodNonce' => $dati['payment_method_nonce'],
            'deviceData' => $dati['device_data'],
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if (!$result->success) {
            $error = $result->message;
            return view('admin.users.payment-error', compact('error'));
        } else {
            $sponsorship = Sponsorship::where('name', '=', $dati['tier'])->first();

            $final_sponsorship = $user->sponsorships()
                ->wherePivot('date_end', '>', now())
                ->orderByDesc('pivot_date_end')
                ->first();

            if ($final_sponsorship) {
                // se c'è almeno una sponsorizzazione attiva da qui al futuro, prendiamo la sua data finale
                // e creaiamo una nuova sponsorship a partire da quella
                $final_sponsorship_end = Carbon::parse($final_sponsorship->pivot->date_end);
                $new_sponsorship_end = $final_sponsorship_end->copy()->addHours($sponsorship->duration_h);
                $user->sponsorships()
                    ->attach($sponsorship->id, ['date_start' => $final_sponsorship_end->copy()->addSecond(), 'date_end' => $new_sponsorship_end]);
                $sponsorship_end_msg = $new_sponsorship_end->format('d/m/Y H:i:s');
                return view('admin.users.payment-success',compact('sponsorship_end_msg'));
            } else {
                // se non c'è una sponsorizzazione attiva a partire da ora,
                // cheriamo una nuova sponsorship a partire da ora.
                $new_sponsorship_end = now()->addHours($sponsorship->duration_h);
                $user->sponsorships()
                    ->attach($sponsorship->id, ['date_start' => now(), 'date_end' => $new_sponsorship_end]);
                $sponsorship_end_msg = $new_sponsorship_end->format('d/m/Y H:i:s');
                return view('admin.users.payment-success',compact('sponsorship_end_msg'));
            }
            // $user->sponsorships()->attach($sponsorship->id, ['date_start' => now(), 'date_end' => now()->addHours($sponsorship->duration_h)]);
            // dd($sponsorship);
        }
        // dd($result->success, $result->message, $result);
    }

    private function generateUserSlugFromName($name, $surname)
    {
        $base_slug = Str::slug($name . '_' . $surname, '-');
        $slug = $base_slug;
        $count = 1;
        $user_found = User::where('slug', '=', $slug)->first();
        while ($user_found) {
            $slug = $base_slug . '-' . $count;
            $user_found = User::where('slug', '=', $slug)->first();
            $count++;
        }
        return $slug;
    }

    private function getValidate()
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'photo' => 'image|max:512',
            'specialties' => 'required|exists:specialties,id',
            'cv' => 'nullable|string|max:5000',
            'address' => 'required|string|nullable|',
            'services' => 'nullable|string|max:1000',
            'phone_number' => 'string|max:255',
        ];
    }
}
