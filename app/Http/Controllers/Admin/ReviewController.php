<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index() {
        $user = Auth::user();
        $reviews = Review::where('user_id', '=', $user->id)->simplepaginate(5);
        
        // return view('admin.home', compact('user'));

        return view('admin.reviews.index', compact('user', 'reviews'));
    }
}
