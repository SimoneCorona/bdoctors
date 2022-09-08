<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    public function index($user_slug){
        $reviews = Review::with('user')->whereHas('user', function ($query) use ($user_slug)
        {
            $query->where('slug', '=', $user_slug);
        
        })->paginate(15);
        // dd($reviews);
        if ($reviews) {
            return response()->json([
                'success' => true,
                'results' => $reviews
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Nessuna recensione'
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            "user_id" => "required|exists:users,id",
            "author" => "required|min:2,max:50",
            "rating" => "required|min:1,max:5|integer",
            "text_review" => "string|nullable",
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "response" => $validator->errors(),
            ]);
        } else {
            $new_review = new Review();
            $new_review->fill($data);
            // dd($new_review);
            $new_review->save();
            
            return response()->json([
                "success" => true,
            ]);
        }
    }


    
    
}
