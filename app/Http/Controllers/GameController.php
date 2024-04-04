<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use Auth;
use Validator;

class GameController extends Controller
{
    public function __construct()
    {

    }

    // Checks if a game is active and starts the game
    public function index()
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        // If there is no active game, redirect to new-game page
        if (empty($data))
            return redirect('new-game');

        $members = $data->player()->get();

        return view('game.index', compact('members'));
    }

    // Create new-game page
    public function create()
    {
        $count = Auth::user()->game->where('ended', null)->count();

        return view('create', compact('count'));
    }

    // Creating new game
    public function store(Request $request)
    {
        // Validate requests
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

        // Complete previous games if exists
        Game::where('user_id', Auth::user()->id)->update([
            'ended'      => 1
        ]);

        // Create new game
        $insert = Auth::user()->game()->create([
            'title'     => $request['title'],
            'count'     => $request['n'],
            'bomba'     => $request['bomba'] ? 1 : null,
        ]);

        // Add game players
        foreach ($request['d'] as $key => $d) {
            Player::create([
                'game_id'   => $insert->id,
                'name'      => $d,
            ]);
        }

        return redirect('game');
    }

    public function bomba($data)
    {
        $memb = unserialize($data->members);

        foreach ($memb as $us) {
            foreach ($us as $ua => $s) {
                $members[] = [$ua => ($s + 1)];
            }
        }

        $data->update([
            'shots'     => $data->shots + count((array)$memb),
            'members'   => serialize($members)
        ]);

    }

    public function shot($data, $member)
    {
        if (isset($member)) {
            $memb = unserialize($data->members);

            $i = -1;

            foreach ($memb as $us) {
                foreach ($us as $ua => $s) {
                    $i++;

                    $plus = $i == $member ? $s + 1 : $s;

                    $members[] = [$ua => $plus];
                }
            }

            $update['shots'] = $data->shots + 1;
            $update['members'] = serialize($members);

            $data->update($update);
        }
    }

    public function game(Request $request)
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        if (empty($data))
            return 'Nothing special! (:';
        else {
            if ($request->query('do') == 'bomba')
                $this->bomba($data);

            if ($request->query('do') == 'drink') {
                $explode = explode(',', $request->query('member'));

                foreach($explode as $e) {
                    $this->shot($data, $e);
                }
            }

            $players = $data->player()->get();

            $random = Game::random();
            $player = Player::random($players);
            $show = $data->action($random, $player);

            $decode = [
                'random'    => $show,
                'id'        => $player,
                'count'     => $data->player()->count(),
                'plus'      => $random,
            ];

            return json_encode($decode);
        }
    }

    public function stop()
    {
        Game::where('user_id', Auth::user()->id)->update([
            'ended'      => 1
        ]);

        return back();
    }
}
