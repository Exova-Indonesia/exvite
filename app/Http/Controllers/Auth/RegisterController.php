<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Str;
use Lang;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Request;
use Illuminate\Foundation\Auth\RegistersUsers;
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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = url()->previous();
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
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $id = date('Ymd').rand();
            $user = User::create([
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => "http://localhost:8000/images/users/default.png",
            'subscription' => 'Newbie',
            'api_token' => Str::random(60),
        ]);
            Wallet::create([
            'wallet_id' => date('Ymd').rand(),
            'user_id' => $id,
        ]);
        Activity::create([
            'activity_id' => date('Ymdhis').rand(0, 1000),
            'user_id' => Auth::user()->id ?? '',
            'activity' => Lang::get('activity.user.register'),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
        return $user;
    }
}
