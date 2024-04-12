<?php

namespace App\Http\Controllers;

use App\Http\Requests\InfoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\Player;
use App\Models\Info;
use Auth;

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
        Info::create([
            'title'     => $request->title,
            'icon'      => $request->icon,
            'content'   => $request->content,
            'visible'   => $request->visible
        ]);

        return redirect('/admin/info');
    }

    // Show Information page
    public function edit($id)
    {
        $data = Info::where(['id' => $id])->firstOrFail();

        return view('admin.info.edit', compact('data'));
    }

    // Edit Information page
    public function update(InfoRequest $request)
    {
        $data = Info::findOrFail($request->id);

        $data->update([
            'title'     => $request->title,
            'icon'      => $request->icon,
            'content'   => $request->content,
            'visible'   => $request->visible,
            'editor'    => Auth::user()->id,
        ]);

        return back()->with('status', 'Informācijas sadaļa izlabota!');
    }

    // Delete Information page
    public function destroy($id)
    {
        $data = Info::where(['id' => $id])->firstOrFail();
        $data->delete();

        return redirect()->back()->with('deleted', 'Informāciju sadaļa izdzēsta!');
    }
}
