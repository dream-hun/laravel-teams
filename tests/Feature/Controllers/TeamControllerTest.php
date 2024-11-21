<?php

use App\Models\Team;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('switches the current team for the user', function () {
    $user = User::factory()->create();

    $user->teams()->attach(
        $team = Team::factory()->create()
    );

    actingAs($user)
        ->patch(route('team.set-current', $team))
        ->assertRedirect();

    expect($user->currentTeam->id)->toBe($team->id);
});
