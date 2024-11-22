<?php

use App\Models\Team;
use App\Models\TeamInvite;
use App\Models\User;
use Illuminate\Support\Str;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

afterEach(function () {
   Str::createRandomStringsNormally();
});

it('creates an invite', function () {
    $user = User::factory()->create();

    Str::createRandomStringsUsing(fn () => 'abc');

    actingAs($user)
        ->post(route('team.invites.store', $user->currentTeam), [
            'email' => $email = 'mabel@codecourse.com'
        ])
        ->assertRedirect();

    assertDatabaseHas('team_invites', [
        'team_id' => $user->currentTeam->id,
        'email' => $email,
        'token' => 'abc'
    ]);
});

it('requires an email address', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('team.invites.store', $user->currentTeam))
        ->assertSessionHasErrors('email');
});

it('fails to create invite if email already used', function () {
    $user = User::factory()->create();

    TeamInvite::factory()->create([
        'team_id' => $user->currentTeam->id,
        'email' => $email = 'mabel@codecourse.com'
    ]);

    actingAs($user)
        ->post(route('team.invites.store', $user->currentTeam), [
            'email' => $email
        ])
        ->assertInvalid();
});

it('creates invite if email already invited to another team', function () {
    $user = User::factory()->create();

    TeamInvite::factory()
        ->for(Team::factory())
        ->create([
            'email' => $email = 'mabel@codecourse.com'
        ]);

    actingAs($user)
        ->post(route('team.invites.store', $user->currentTeam), [
            'email' => $email
        ])
        ->assertValid();
});
