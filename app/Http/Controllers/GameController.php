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

        // If there is no active game, redirect to new-game page
        if (empty($data))
            return redirect('new-game');

        $members = $data->player()->get();

        return view('game.stats', compact('members'));
    }

    // public function bomba($data)
    // {
    //     $memb = unserialize($data->members);

    //     foreach ($memb as $us) {
    //         foreach ($us as $ua => $s) {
    //             $members[] = [$ua => ($s + 1)];
    //         }
    //     }

    //     $data->update([
    //         'shots'     => $data->shots + count((array)$memb),
    //         'members'   => serialize($members)
    //     ]);

    // }

    // public function shot($data, $member)
    // {
    //     if (isset($member)) {
    //         $memb = unserialize($data->members);

    //         $i = -1;

    //         foreach ($memb as $us) {
    //             foreach ($us as $ua => $s) {
    //                 $i++;

    //                 $plus = $i == $member ? $s + 1 : $s;

    //                 $members[] = [$ua => $plus];
    //             }
    //         }

    //         $update['shots'] = $data->shots + 1;
    //         $update['members'] = serialize($members);

    //         $data->update($update);
    //     }
    // }

    public function start(Request $request)
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        if (!empty($data)) {
            $players = $data->player()->get();

            return json_encode($players);
        }
    }

    public function action(Request $request)
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        if (!empty($data)) {
            $random = Game::random($data->bomb);
            $player = Player::random($data->player()->get());

            if ($random == 'inc_one' || $random == 'inc_two') {
                $inc = $random == 'inc_one' ? 1 : 2;

                if ($player->count + $inc >= $data->count) {
                    $count = $data->count;
                    $display = "Dzer <span class='x2 text-primary'>$player->name</span>";
                    $stop = true;
                    $audio = 'drink';

                    $player->increment('shots');
                    $data->player()->update(['count' => 0]);
                } else {
                    $count = $player->count + $inc;
                    $display = $player->name . "<span class='x2 text-danger plus'>+$inc</span>";

                    $player->increment('count', $inc);
                }
            } else if ($random == 'inc_all') {
                //
            } else if ($random == 'dec_one') {
                if ($player->count <= 0) {
                    $random = 'noone';
                    $count = $player->count;
                    $display = 'Neviens';
                } else {
                    $count = $player->count - 1;
                    $display = $player->name . "<span class='x2 text-success plus'>-1</span>";

                    $player->decrement('count');
                }
            } else if ($random == 'noone') {
                $count = $player->count;
                $display = 'Neviens';
            } else if ($random == 'bomb') {
                //
            }

            $encode = [
                'random'    => $random,
                'player'    => $player->id,
                'count'     => $count,
                'display'   => $display,
                'stop'      => $stop ?? false,
                'audio'     => $audio ?? null,
            ];

            return json_encode($encode);
        }
    }

    public function stop()
    {
        Game::where('user_id', Auth::user()->id)->update(['ended' => 1]);

        return back();
    }
}
