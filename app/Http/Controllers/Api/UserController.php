<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['specialties', 'reviews', 'sponsorships'])->get();
        foreach ($users as $user) {
            $user->rating_average = $user->avg_rating(); 
        }
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
            $user->rating_average = $user->avg_rating(); 
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
}
