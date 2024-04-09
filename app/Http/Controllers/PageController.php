<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Game;
use App\Models\Player;
use App\Models\Settings;
use Validator;
use Mail;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function test()
    {
        $players = [];

        $players[] = 'Dāvis';
        $players[] = 'Edgars';

        $random = Game::action(Game::random(), $players);
        //return Game::find(3)->action($random, Player::random($players));
        //dd($players);
        return $random;
    }

	public function info()
    {
        return view('info');
    }

	public function contact(Request $request)
	{
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required'
        ]);

        Mail::send('email', [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'comment' => $request->get('comment') ],
            function ($message) {
                    $message->from('game@etr.lv', 'Buhality');
                    $message->to('game@etr.lv', 'Buhality')
                            ->subject('Buhality kontaktu forma');
        });

        return back()->with('success', 'Paldies! Jūsu ziņa nosūtīta!');

    }
}
