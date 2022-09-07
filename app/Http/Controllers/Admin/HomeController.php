<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        // recuperiamo l'anno attuale
        $current_year_string = now()->format('Y');
        $current_year = Carbon::createFromFormat('Y-m-d H:i',$current_year_string.'-01-01 00:00');

        // otteniamo tutte le review create a partire dall'anno attuale
        $user_reviews = Review::where('user_id', '=', $user->id)->where('created_at','>',$current_year)->get();
        // dd($user_reviews);

        //creaimo una struttura che conterrà una serie di collection annidate contenenti i voti divisi per mese
        $review_counter = collect([]);
        $review_counter[$current_year_string] = collect(array('review_count' => 0, 'ratings' => collect([]), 'months' => collect([])));
        for ($m=1; $m <= 12 ; $m++) { 
            $month_string = str_pad(strval($m), 2, '0', STR_PAD_LEFT);
            $year_month_string = $current_year_string.'-'.$month_string;
            $review_counter[$current_year_string]['months'][$year_month_string] = collect(array('review_count' => 0, 'ratings' => collect([])));
        }
        // dd($review_counter);

        // inseriamo i dati di ciascuna review dentro la struttura nel posto giusto
        foreach ($user_reviews as $key => $value) {
            $year_label = $value->created_at->format('Y');
            $year_month_label = $value->created_at->format('Y-m');
            // dd(gettype($year_label));
            // echo $value->created_at->format('Y-m').'<br>';
            // if (!$review_counter->keys()->contains($year_label)) {
            //     $review_counter[$year_label] = collect(array('review_count' => 0, 'ratings' => collect([]), 'months' => collect([])));
            // }
            // if (!$review_counter[$year_label]['months']->keys()->contains($year_month_label)) {
            //     $review_counter[$year_label]['months'][$year_month_label] = collect(array('review_count' => 0, 'ratings' => collect([])));
            // }
            $review_counter[$year_label]['review_count'] += 1;
            $review_counter[$year_label]['ratings']->push($value->rating);
            $review_counter[$year_label]['months'][$year_month_label]['review_count'] += 1;
            $review_counter[$year_label]['months'][$year_month_label]['ratings']->push($value->rating);
        }

        // creiamo una seconda struttura che conterrà i voti medi per mese/anno e il conteggio per mese/anno
        $review_stats = collect([]);
        foreach ($review_counter as $year => $year_value) {
            $year_array = array(
                'review_count' => $year_value['review_count'],
                'review_avg' => $year_value['ratings']->avg(),
                'months' => collect([])
            );
            $review_stats[$year] = collect($year_array);
            foreach ($year_value['months'] as $month => $month_value) {
                $month_array = array(
                    'review_count' => $month_value['review_count'],
                    'review_avg' => $month_value['ratings']->avg(),
                );
                $review_stats[$year]['months'][$month] = collect($month_array);
            }
            $review_stats[$year]['months'] = $review_stats[$year]['months']->sortKeys();
        }
        // $review_counter['2022'] = $review_counter['2022']->sortKeys();
        // dd($review_counter,$review_counter['2022']['2022-08']['ratings']->avg());
        // dd($review_counter);
        // dd($review_stats);
        return view('admin.home', compact('user','review_stats'));
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
