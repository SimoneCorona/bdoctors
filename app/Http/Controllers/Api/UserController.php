<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['specialties', 'reviews', 'sponsorships'])->get();
        // foreach ($users as $user) {
        //     $user->rating_average = $user->avg_rating(); 
        // }
        // SELECT users.*,                                      ---->//selezioniamo tutte le colonne di users 
        // AVG(reviews.rating) as avg_rating,                   ---->//il calcolo della media(parametro passato) come "nome_fittizzio",
        // specialty.specialty_name,                            ------>//    
        // 
        // FROM users                                           ------>dalla tabella users
        // LEFT JOIN reviews on reviews.user_id = users.id      ----->le reviews collegate tramite reviews.user_id = users.id 
        // GROUP BY users.id                                    ----->raggruppati per users.id
        
        // $users_id = User::with(['specialties', 'reviews', 'sponsorships', ])
        //     ->groupBy('users.id');
        // dd($users_id->get());

        return response()->json([
            'success' => true,
            'results' => $users
        ]);
    }

    public function show($slug){
        $user = User::where('slug', '=', $slug)->with(['specialties', 'reviews', 'sponsorships'])->first();
        if ($user) {
            if($user->photo) {
                $user->photo = url('storage/' . $user->photo);
            } 
            // $user->rating_average = $user->avg_rating(); 
            return response()->json([
                'success' => true,
                'results' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Nessun utente'
            ]);
        }
    }

    public function search($specialty_slug){
        $doctor = User::with(['specialties', 'reviews', 'sponsorships'])->whereHas('specialties', function (Builder $query) use($specialty_slug) {
            $query->where('specialty_slug', '=', $specialty_slug);
        })->get();
        if($doctor) {
            return response()->json([
                'success' => true,
                'results' => $doctor,
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'results' => 'Nessun dottore trovato'
            ]);
        }
    }      
}

