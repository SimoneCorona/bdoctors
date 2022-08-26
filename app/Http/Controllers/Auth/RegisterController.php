<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Specialty;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            // 'specialty' => ['required', 'exists:specialties, id'],
            // 'slug' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $specialty= User::specialties();
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'address' => $data['address'],
            // 'slug' => $this->generateUserSlugFromName($data['name'], $data['surname']),
            'specialty' => $data['specialties_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }



    // private function generateUserSlugFromName($name, $surname) {
    //     $base_slug = Str::slug($name . '_' . $surname, '-');   
    //     $slug = $base_slug;
    //     $count = 1;
    //     $user_found = User::where('slug', '=', $slug)->first();
    //     while ($user_found) {
    //         $slug = $base_slug . '-' . $count;
    //         $user_found = User::where('slug', '=', $slug)->first();
    //         $count++;
    //     }
    //     return $slug;
    // }
}
