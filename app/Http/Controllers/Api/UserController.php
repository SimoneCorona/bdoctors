<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sponsorship;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['specialties'])->get();
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

    public function index_sponsored(){
        $users = User::with(['specialties'])->whereHas('sponsorships', function (Builder $query) {
            $query->whereRaw('(now() between date_start and date_end)');
        })->paginate(12);
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
    
    // funzione chiamata dalla route /search/
    // accetta la richiesta GET e una stringa ($specialty_slug)
    public function search(Request $request,$specialty_slug){
        // inizializziamo una query al modello user
        $query = User::query();
        // ci aggiungiamo l'eager loading delle relationships
        $query->with(['specialties']);
        // se lo specialty slug è truthy
        $query->withCount('reviews');
        $query->withAvg('reviews','rating');
        if ($specialty_slug) {
            //aggiungiamo una query alla relationship
            $query->whereHas('specialties', function (Builder $query) use($specialty_slug) {
                $query->where('specialty_slug', '=', $specialty_slug);
            });
        }
        // Aggiungiamo il filtro HAVING per il numero di review
        if ($request->filled('min_reviews')) {
            $query->having('reviews_count','>=',$request->min_reviews);
        }
        // Aggiungiamo il filtro HAVING per la media dei voti
        if ($request->filled('avg_rating')) {
            $query->having('reviews_avg_rating','>=',$request->avg_rating);
        }
        // eseguiamo la query e paginiamo.
        $doctors = $query->get();
        // dd($doctors);
        
        // se la collection risultante è popolata, mandiamo la response di successo
        if($doctors) {
            return response()->json([
                'success' => true,
                'results' => $doctors,
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