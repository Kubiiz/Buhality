<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
//use App\Conection;
use App\Game;
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
                    $message->from('buhality@etr.lv', 'Buhality');
                    $message->to('buhality@etr.lv', 'Buhality')
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

    public function redirectToProvider($provider)
    {
        if (!Auth::guest() and Social::where('user_id', Auth::user()->id)->where('provider', $provider)->first()) {
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

        $conection = Conection::where('pro_id', $soc_user->getId())->first();

        if (!$conection) {
			$users = User::where('email', $soc_user->getEmail())->first();

			if (!$users) {
				$user = User::Create([
					'email' => empty($soc_user->getEmail()) ? $soc_user->getId() . '@eternal' : $soc_user->getEmail(),
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
