<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Game;
//use App\Conection;
use Socialite;
use Validator;
use Illuminate\Support\Str;
use Mail;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
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

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        if (is_array($request['d'])) {
            if (count($request['d']) < 2) {
                $fields['d'] = '';
                $rules['d'] = 'required';
            }
            else
                foreach ($request['d'] as $key => $d) {
                    $fields['d' . $key] = $d;
                    $rules['d' . $key] = 'required|min:3';
                }
        }
        else {
            $fields['d'] = '';
            $rules['d'] = 'required';
        }

        $fields['title'] = $request['title'];
        $rules['title'] = 'required|min:3|max:20';
        $fields['n'] = $request['n'];
        $rules['n'] = 'required|numeric|min:3|max:15';

        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        foreach($request['d'] as $d) {
            $da[] = [$d => 0];
        }

        Game::where('user_id', Auth::user()->id)->update([
            'active'      => 1
        ]);

        Auth::user()->game()->create([
            'title'     => $request['title'],
            'count'     => $request['n'],
            'bomba'     => $request['bomba'] ? 3 : 1,
            'shots'     => $request['text'],
            'members'   => serialize($da)
        ]);

        return redirect('game');
    }
}
