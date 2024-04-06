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
        $players = Game::find(3)->player()->get();
        $random = Game::random(1);
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

    public function history()
    {
        $game = Auth::user()->game;

        $active = $game->where('active', 0)->first();
        $data = Game::where(['user_id'=> Auth::user()->id, 'active' => 1])->latest()->get();
        $count = count($data);
        $sum = $game->sum('shots');

        return view('history', compact('data', 'active', 'count', 'sum'));
    }

    public function destroy($id)
    {
        $data = Game::where(['user_id'=> Auth::user()->id, 'id' => $id])->firstOrFail();

        $data->delete();

        return redirect('history');
    }
}
