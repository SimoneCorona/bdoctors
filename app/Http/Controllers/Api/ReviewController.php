<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            "user_id" => "required|exists:users,id",
            "author" => "required|min:2,max:50",
            "rating" => "required|digits_between:0,5|integer",
            "text_review" => "required|min:10",
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
