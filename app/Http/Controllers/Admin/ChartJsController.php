<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\Review;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChartJsController extends Controller
{
    public function index()
    {   
        // Un medico ha la possibilità di vedere le seguenti statistiche:
        // numero di messaggi e recensioni ricevute per mese/anno
        // grafico a barre fasce di voto ricevuti per mese/anno

        $user = Auth::user();
        // $reviews = $user->reviews;
        // $messages = $user->messages;
        // $total_reviews = count($reviews);
        // $total_msg = count($messages);
        // $total_count = count($reviews) + count($messages);
        $month = date('m');
        $year = date('Y');
        $currentMonth = $month;
        $currentYear = $year;

        $messagesXmonth = Message::where('user_id', '=', $user->id)->whereMonth('created_at', '=', $currentMonth)->get();
        $reviewsXmonth = Review::where('user_id', '=', $user->id)->whereMonth('created_at', '=', $currentMonth)->get();

        

        
        
        
        
        
        
        // $data = [
        //     'totaleRecensioni' => $total_reviews,
        //     'totaleMessaggi' => $total_msg,
        //     'totaleSomma' => $total_count
        // ];
        
        

        

        return view('admin.chart.index');
    }
}
