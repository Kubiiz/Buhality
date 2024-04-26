<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Validation\Rule;
use App\Classes\Action;
use Auth;

class GameController extends Controller
{
    // Checks if a game is active and starts the game
    public function index()
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        // If there is no active game, redirect to new-game page
        if (empty($data)) {
            return redirect('new-game');
        }

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
        Game::where('user_id', $request->user()->id)->update(['ended' => 1]);

        // Create new game
        $game = $request->user()->game()->create($request->all());

        // Add game players
        foreach ($request->player as $key => $value) {
            $game->player()->create([
                'name'      => $value,
            ]);
        }

        return redirect('game');
    }

    // Show Edit game view
    public function edit(Game $game)
    {
        if ($game->user_id != Auth::user()->id) {
            return redirect('new-game');
        }

        $players = $game->player()->get();

        return view('game.edit', compact('game', 'players'));
    }

    // Update game
    public function update(Game $game, GameRequest $request)
    {
        if ($game->user_id != Auth::user()->id) {
            return back();
        }

        // Update game
        $game->update($request->merge([
            'bomb' => $request->bomb ?? null,
        ])->toArray());

        // Delete game players if not exists anymore
        $game->player()->whereNotIn('name', $request->player)->delete();

        // Create new game players if is edited or added new
        foreach ($request->player as $key => $value) {
            $player = $game->player()->where('name', $value)->first();

            if (!$player) {
                $game->player()->create([
                    'name'      => $value,
                ]);
            }
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

        if (empty($data)) {
            return false;
        }


        $members = $data->player()->get();

        return view('game.stats', compact('members'));
    }

    // Reset counter
    public function reset()
    {
        $data = Auth::user()->game->whereNull('ended')->first();

        if (empty($data)) {
            return false;
        }

        $data->player()->update(['count' => 0]);

        return true;
    }

    // Play the game. Get a random action and do something
    public function action()
    {
        $game = new Action();

        return $game->show();
    }

    // Finish the game
    public function stop()
    {
        Game::where('user_id', Auth::user()->id)->update(['ended' => 1]);

        return back();
    }

    // Check if game isn't finished and continue it
    public function continue(Game $game)
    {
        if ($game->user_id == Auth::user()->id && $game->ended == 1) {
            $game->update(['ended' => null]);
        }

        return redirect('game');
    }

    // Delete game and game players
    public function destroy(Game $game)
    {
        if ($game->user_id == Auth::user()->id) {
            $game->player()->delete();
            $game->delete();
        }

        return redirect()->back()->with('deleted', __('Game deleted!'));
    }
}
