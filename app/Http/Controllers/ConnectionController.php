<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use App\Models\Connection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Socialite;

class ConnectionController extends Controller
{
    public function redirectToProvider($provider)
    {
        if (!Auth::guest() and Connection::where('user_id', Auth::user()->id)->where('provider', $provider)->first()) {
            return redirect(url()->previous());
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try
        {
            $soc_user = Socialite::driver($provider)->user();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }

        $conection = Connection::where('pro_id', $soc_user->getId())->first();

        if (!$conection) {
			$users = User::where('email', $soc_user->getEmail())->first();

			if (!$users) {
				$user = User::Create([
					'email' => empty($soc_user->getEmail()) ? $soc_user->getId() . '@game' : $soc_user->getEmail(),
					'name' => $soc_user->getName(),
					'password' => bcrypt(Str::random(15))
				]);
			} else
				$user = $users;

            $user->conection()->create(
                ['pro_id' => $soc_user->getId(), 'provider' => $provider]
            );
        } else {
            $user = $conection->user;
        }

        auth()->login($user);

        return redirect('/');
    }
}
