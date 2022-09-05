<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Specialty;
use App\Sponsorship;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        $user->slug = $this->generateUserSlugFromName($user->name,$user->surname);
        $user->save();
        if(isset($data['specialties'])) {
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
        $user->slug = $this->generateUserSlugFromName($user->name,$user->surname);
        $user->update($data);
        // dd($user);
        if(isset($data['specialties'])) {
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


    private function generateUserSlugFromName($name, $surname) {
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

    private function getValidate(){
        return [
            'name' => 'required|string|max:255',
            'surname'=> 'required|string|max:255',
            'photo' => 'image|max:512',
            'specialties' => 'required|exists:specialties,id',
            'cv' => 'nullable|string|max:5000',
            'address' => 'required|string|nullable|',
            'services' => 'nullable|string|max:1000',
            'phone_number' => 'string|max:255',
        ];
    }
}    

