<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Game;
use App\Models\Player;
use App\Models\Settings;
use App\Models\Info;
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
        $data = Info::where('visible', 1)->get();

        return view('info', compact('data'));
    }

	public function contact(Request $request)
	{
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'comment'   => 'required'
        ]);

        Mail::send('email', [
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'comment'   => $request->get('comment') ],
            function ($message) {
                    $message->from('buhality@etr.lv', 'Buhality');
                    $message->to('buhality@etr.lv', 'Buhality')
                            ->subject('Buhality kontaktu forma');
        });

        return back()->with('success', 'Paldies! Jūsu ziņa nosūtīta!');
    }
}
