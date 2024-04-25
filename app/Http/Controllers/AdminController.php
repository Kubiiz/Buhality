<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\Player;
use App\Models\Info;

class AdminController extends Controller
{
    // Display admin page
    public function index()
    {
        $users = User::count();
        $games = Game::count();
        $players = Player::count();
        $shots = Player::sum('shots');

        return view('admin.index', compact('users', 'games', 'players', 'shots'));
    }

    // Display Information page
    public function info()
    {
        $data = Info::all();

        return view('admin.info.index', compact('data'));
    }

    // Add new Information page
    public function create()
    {
        return view('admin.info.create');
    }

    // Create Information page
    public function store(InfoRequest $request)
    {
        Info::create($request->all());

        return redirect('/admin/info');
    }

    // Show Information page
    public function edit(Info $info)
    {
        return view('admin.info.edit', compact('info'));
    }

    // Edit Information page
    public function update(Info $info, InfoRequest $request)
    {
        $info->update($request->merge([
            'visible' => $request->visible ?? null,
            'editor' => $request->user()->id
        ])->toArray());

        return back()->with('status', __('Information section updated!'));
    }

    // Delete Information page
    public function destroy(Info $info)
    {
        $info->delete();

        return redirect()->back()->with('deleted', __('Information section deleted!'));
    }
}
