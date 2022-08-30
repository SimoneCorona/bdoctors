<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index(){
        $specialties = Specialty::all();
        
        return response()->json([
            'success' => true,
            'results' => $specialties,
        ]);
    }
}
