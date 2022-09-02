<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            "user_id" => "required|exists:users,id",
            "author" => "required|min:2,max:50",
            "text_message" => "required|min:10",
            "email" => "required|email:rfc",
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "response" => $validator->errors(),
            ]);
        } else {
            $new_message = new Message();
            $new_message->fill($data);
            // dd($new_message);
            $new_message->save();
            
            return response()->json([
                "success" => true,
            ]);
        }
    }
    
    
}
