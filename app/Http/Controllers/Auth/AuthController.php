<?php

namespace App\Http\Controllers\Auth;

use Lang;
use App\Models\Activity;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Str;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect()->intended();
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            Activity::create([
                'activity_id' => date('Ymdhis').rand(0, 1000),
                'user_id' => $authUser->id,
                'activity' => Lang::get('activity.user.with').$provider,
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
            return $authUser;
        }
        else{
            $id = date('Ymd').rand();
            Wallet::create([
                'wallet_id' => date('Ymd').rand(),
                'user_id' => $id,
            ]);
            $data = User::create([
                'name'     => $user->name,
                'email'    => !empty($user->email)? $user->email : '' ,
                'phone'    => !empty($user->phone)? $user->phone : '' ,
                'avatar'   => $user->avatar . "&access_token=" . $user->token,
                'provider' => $provider,
                'provider_id' => $user->id,
                'id' => $id,
                'subscription' => 'Newbie',
                'api_token' => Str::random(60),
            ]);
            Activity::create([
                'activity_id' => date('Ymdhis').rand(0, 1000),
                'user_id' => $id,
                'activity' => Lang::get('activity.user.with').$provider,
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
            return $data;
        }
    }
}