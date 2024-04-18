<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $data = $request->user();

        return view('profile.edit', [
            'user' => $data,
            'date' => Carbon::parse($data->birth_date)->format('Y-m-d'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->birth_date = Carbon::parse($request->birth_date)->format('Y-m-d');

        $request->user()->save();

        return Redirect::route('profile.edit')->with('profile.updated', __('Profile information updated!'));
    }
}
