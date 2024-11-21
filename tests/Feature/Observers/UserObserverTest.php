<?php

use App\Models\Team;
use App\Models\User;
use function Pest\Laravel\assertDatabaseEmpty;

it('creates a personal team when a user is created', function () {
    $user = User::factory()->create([
        'name' => 'Alex'
    ]);

    expect($user->teams)
        ->toHaveCount(1)
        ->first()->name->toBe($user->name);
});

it('removes all team attachments when deleted', function () {
    $user = User::factory()
        ->has(Team::factory()->times(2))
        ->createQuietly();

    $user->delete();

    assertDatabaseEmpty('team_user');
});
