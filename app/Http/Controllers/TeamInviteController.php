<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamInviteStoreRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamInviteController extends Controller
{
    public function store(TeamInviteStoreRequest $request, Team $team)
    {
        $invite = $team->invites()->create([
            'email' => $request->email,
            'token' => str()->random(30)
        ]);

        return back()->withStatus('team-invited');
    }
}
