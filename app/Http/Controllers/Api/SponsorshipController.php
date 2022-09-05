<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sponsorship;
use App\User;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public static function index() {
        $sponsorships = Sponsorship::all();

        return response()->json([
            'success' => true,
            'results' => $sponsorships,
        ]);
    }
}
