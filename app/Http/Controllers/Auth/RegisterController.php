<?php

namespace agendaInfantil\Http\Controllers\Auth;

use agendaInfantil\User;
use agendaInfantil\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    

public function slug_user($str) {
        $clean = trim($str);
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
        $clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
    
        $clean = preg_replace("/[_| -]+/", '-', $clean); // aquí permite el slash
    
        if (substr($clean, -1) == '/') {
            $clean = substr($clean, 0, -1);
        }
    
        return $clean;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \agendaInfantil\User
     */
    protected function create(array $data)
    {
        $user_slug = $this->slug_user($data['name'].' '.$data['username1'].' '.$data['username2']);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username1' => $data['username1'],
            'username2' => $data['username2'],
            'birth_date' => $data['birth_date'],
            'user_slug' => $user_slug,
            'rol_id' => 3,
            'user_image' => null,
        ]);
    }
}
