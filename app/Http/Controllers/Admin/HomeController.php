<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // recuperiamo la data di inizio del mese che correva 11 mesi fa (esempio: oggi è l'8 settembre 2022 -> 1 ottobre 2021)
        // in questo modo avremo i dati per 12 mesi (gli 11 passati più il mese in corso)
        $retrieval_start_date = now()->subMonths(11)->startOfMonth();
        $retrieval_start_year = $retrieval_start_date->copy();
        $retrieval_start_month = $retrieval_start_date->copy();

        // otteniamo tutte le review create a partire da 12 mesi fa
        $user_reviews = Review::where('user_id', '=', $user->id)->where('created_at', '>', $retrieval_start_date)->get();
        // otteniamo anche tutti i messaggi
        $user_messages = Message::where('user_id', '=', $user->id)->where('created_at', '>', $retrieval_start_date)->get();
        // dd($user_reviews);

        // creiamo un array di mesi da includere nella nostra collection,
        // ovvero tutte le date inizio mese (formato Oggetto Carbon) a partire dalla retrieval_start_date
        $month_array = [];
        while (now()->format('Y-m') >= $retrieval_start_month->format('Y-m')) {
            array_push($month_array, $retrieval_start_month->copy());
            $retrieval_start_month->addMonth();
        }
        // dd($month_array);

        //creaimo una struttura che conterrà una serie di collection annidate contenenti i voti divisi per mese
        $review_counter = collect([]);
        // creiamo una struttura analoga per i messaggi
        $message_counter = collect([]);

        // cicliamo in nostro month_array e inseriamo i mesi nelle strutture, annidati correttamente
        foreach ($month_array as $key => $value) {
            $year_label = $value->format('Y');
            $year_month_label = $value->format('Y-m');
            if (!$review_counter->keys()->contains($year_label)) {
                $review_counter[$year_label] = collect(array('review_count' => 0, 'ratings' => collect([]), 'months' => collect([])));
            }
            if (!$message_counter->keys()->contains($year_label)) {
                $message_counter[$year_label] = collect(array('message_count' => 0, 'ratings' => collect([]), 'months' => collect([])));
            }
            if (!$review_counter[$year_label]['months']->keys()->contains($year_month_label)) {
                $review_counter[$year_label]['months'][$year_month_label] = collect(array('review_count' => 0, 'ratings' => collect([])));
            }
            if (!$message_counter[$year_label]['months']->keys()->contains($year_month_label)) {
                $message_counter[$year_label]['months'][$year_month_label] = collect(array('message_count' => 0));
            }
        }
        
        // dd($review_counter);
        // dd($message_counter);

        // inseriamo i dati di ciascuna review dentro la struttura nel posto giusto
        foreach ($user_reviews as $key => $value) {
            $year_label = $value->created_at->format('Y');
            $year_month_label = $value->created_at->format('Y-m');
            $review_counter[$year_label]['review_count'] += 1;
            $review_counter[$year_label]['ratings']->push($value->rating);
            $review_counter[$year_label]['months'][$year_month_label]['review_count'] += 1;
            $review_counter[$year_label]['months'][$year_month_label]['ratings']->push($value->rating);
        }
        // dd($review_counter);
        
        // creiamo una seconda struttura che conterrà i voti medi per mese/anno e il conteggio per mese/anno
        $review_stats = collect([]);
        foreach ($review_counter as $year => $year_value) {
            $year_stats = array(
                'review_count' => $year_value['review_count'],
                'review_avg' => $year_value['ratings']->avg(),
                'months' => collect([])
            );
            $review_stats[$year] = collect($year_stats);
            foreach ($year_value['months'] as $month => $month_value) {
                $month_stats = array(
                    'review_count' => $month_value['review_count'],
                    'review_avg' => $month_value['ratings']->avg(),
                );
                $review_stats[$year]['months'][$month] = collect($month_stats);
            }
            $review_stats[$year]['months'] = $review_stats[$year]['months']->sortKeys();
        }

        // dd($message_counter);
        // inseriamo i dati di ciascun messaggio dentro la struttura nel posto giusto
        foreach ($user_messages as $key => $value) {
            $year_label = $value->created_at->format('Y');
            $year_month_label = $value->created_at->format('Y-m');
            $message_counter[$year_label]['message_count'] += 1;
            $message_counter[$year_label]['months'][$year_month_label]['message_count'] += 1;
        }


        // $review_counter['2022'] = $review_counter['2022']->sortKeys();
        // dd($review_counter,$review_counter['2022']['2022-08']['ratings']->avg());
        // dd($review_counter);
        // dd($message_counter);
        // dd($review_stats);
        return view('admin.home', compact('user', 'review_stats', 'message_counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
