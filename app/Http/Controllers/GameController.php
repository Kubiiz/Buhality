<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use Auth;
use Validator;

class GameController extends Controller
{
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
        $active = Auth::user()->game->where('ended', null)->first();

        return view('create', compact('active'));
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
            'bomb'     => $request['bomba'] ? 1 : null,
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

    // Update game statistics
    public function stats()
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        if (empty($data))
            return false;

        $members = $data->player()->get();

        return view('game.stats', compact('members'));
    }

    // Reset counter
    public function reset()
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        if (empty($data))
            return false;

        $data->player()->update(['count' => 0]);

        return true;
    }

    // Play the game. Get a random action and do something
    public function action()
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        if (empty($data))
            return false;

        $random = Game::random($data->bomb);
        $player = $data->player()->get()->random();
        $display = [];

        if ($random == 'inc_one' || $random == 'inc_two') {
            $inc = $random == 'inc_two' ? 2 : 1;
            $display[] = $player->name;

            if ($player->count + $inc >= $data->count) {
                $count = $data->count;
                $stop = true;
                $audio = 'drink';
                $random = $audio;

                $player->increment('shots');
                $data->player()->update(['count' => 0]);
            } else {
                $count = $player->count + $inc;

                $player->increment('count', $inc);
            }
        } else if ($random == 'inc_all') {
            foreach ($data->player as $players) {
                if ($players->count + 1 >= $data->count) {
                    $stop = true;
                    $audio = 'drink';
                    $random = $audio;
                    $display[] = $players->name;
                    $count[] = [
                        'id'    => $players->id,
                        'count' => $data->count,
                    ];

                    $players->increment('shots');
                    $data->player()->update(['count' => 0]);
                } else {
                    $count[] = [
                        'id'    => $players->id,
                        'count' => $players->count + 1,
                    ];

                    $players->increment('count');
                }
            }
        } else if ($random == 'dec_one') {
            $display[] = $player->name;

            if ($player->count <= 0) {
                $random = 'inc_one';

                if ($player->count + 1 >= $data->count) {
                    $count = $data->count;
                    $stop = true;
                    $audio = 'drink';
                    $random = $audio;

                    $player->increment('shots');
                    $data->player()->update(['count' => 0]);
                } else {
                    $count = $player->count + 1;

                    $player->increment('count');
                }
            } else {
                $count = $player->count - 1;

                $player->decrement('count');
            }
        } else if ($random == 'bomb' && $data->bomb == 1) {
            foreach ($data->player as $players) {
                $count[] = [
                    'id'    => $players->id,
                    'count' => $data->count,
                ];

                $players->increment('shots');
            }

            $data->player()->update(['count' => 0]);

            $stop = true;
            $audio = 'bomb';
        } else if ($random == 'noone') {
            $count = $player->count;
        }

        $encode = [
            'random'    => $random,
            'player'    => $player->id,
            'count'     => $count,
            'display'   => Game::action($random, $display),
            'stop'      => $stop ?? false,
            'audio'     => $audio ?? null,
        ];

        return json_encode($encode);
    }

    // Finish the game
    public function stop()
    {
        Game::where('user_id', Auth::user()->id)->update(['ended' => 1]);

        return back();
    }
}
