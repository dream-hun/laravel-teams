<?php

use App\Models\User;

it('creates a personal team when a user is created', function () {
    $user = User::factory()->create([
        'name' => 'Alex'
    ]);

    expect($user->teams)
        ->toHaveCount(1)
        ->first()->name->toBe($user->name);
});
