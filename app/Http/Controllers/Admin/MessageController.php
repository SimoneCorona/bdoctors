<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index() {
        $user = Auth::user();
        $messages = Message::where('user_id', '=', $user->id)->paginate(5);
        
        // return view('admin.home', compact('user'));

        return view('admin.messages.index', compact('user', 'messages'));
    }
   
}
