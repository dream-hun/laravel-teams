<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function setCurrent(Request $request, Team $team)
    {
        // authorize

        $request->user()->currentTeam()->associate($team)->save();

        return back();
    }
}
