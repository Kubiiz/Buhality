<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\Player;

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
        return view('admin.info');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(admin $admin)
    {
        //
    }
}
