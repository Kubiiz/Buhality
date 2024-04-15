<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Validation\Rule;
use Auth;

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

        return view('game.create', compact('active'));
    }

    // Creating new game
    public function store(GameRequest $request)
    {
        // Complete previous game if exists
        Game::where('user_id', Auth::user()->id)->update(['ended' => 1]);

        // Create new game
        $create = Auth::user()->game()->create([
            'title' => $request->title,
            'count' => $request->count,
            'bomb'  => $request->bomb,
        ]);

        // Add game players
        foreach ($request->player as $key => $value) {
            Player::create([
                'game_id'   => $create->id,
                'name'      => $value,
            ]);
        }

        return redirect('game');
    }

    // Show Edit game view
    public function edit($id)
    {
        $data = Game::where('id', $id)->where('user_id', Auth::user()->id)->first();

        // If game not found redirect to new-game
        if (empty($data))
            return redirect('new-game');

        $players = $data->player()->get();

        return view('game.edit', compact('data', 'players'));
    }

    // Update game
    public function update(GameRequest $request)
    {
        $data = Game::findOrFail($request->id);

        // If game not found redirect back
        if ($data->user_id != Auth::user()->id) {
            return back();
        }

        // Update game
        $data->update([
            'title'     => $request->title,
            'count'     => $request->count,
            'bomb'      => $request->bomb,
        ]);

        // Delete game players if not exists anymore
        Player::where('game_id', $data->id)->whereNotIn('name', $request->player)->delete();

        // Create new game players if is added new
        foreach ($request->player as $key => $value) {
            $player = Player::where('game_id', $data->id)->where('name', $value)->first();

            if (!$player)
                Player::create([
                    'game_id'   => $data->id,
                    'name'      => $value,
                ]);
        }

        return back()->with('status', 'Spēle izlabota!');
    }

    // Show user games
    public function games()
    {
        $data = Auth::user()->game;
        $active = $data->whereNull('ended')->first();
        $games = $data->whereNotNull('ended')->all();

        $shots = Player::whereHas('game', function($query) {
                    $query->where('user_id', Auth::user()->id);
                })->sum('shots');

        return view('game.games', compact('data', 'active', 'games', 'shots'));
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

        // Get a random action and player
        $random = Game::random($data->bomb);
        $player = $data->player()->get()->random();
        $display = [];

        // Check if player count will be increased
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
        }
        // Check if all players counts will be increased
        else if ($random == 'inc_all') {
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
        }
        // Check if player count will be decreased
        else if ($random == 'dec_one') {
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
        }
        // Check for bomb (all players need to drink a shot)
        else if ($random == 'bomb') {
            if ($data->bomb == 1) {
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
            } else {
                $random = 'noone';
                $count = $player->count;
            }
        }
        // Nothing is happening
        else if ($random == 'noone') {
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

    // Continue game
    public function continue($id)
    {
        $exists = Game::where('user_id', Auth::user()->id)->whereNull('ended')->exists();

        if (!$exists)
            Game::where(['id' => $id])->update(['ended' => null]);

        return redirect('game');
    }

    // Delete game and game players
    public function destroy($id)
    {
        $data = Game::where(['user_id'=> Auth::user()->id, 'id' => $id])->firstOrFail();
        $data->delete();
        $data->player()->delete();

        return redirect()->back()->with('deleted', 'Spēle izdzēsta!');
    }
}
