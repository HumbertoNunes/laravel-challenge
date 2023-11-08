<?php

use App\Models\Candidate;
use App\Models\User;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = Candidate::factory([
        'name' => 'Jane Doe',
        'birthdate' => '1985-01-19',
        'gender' => 'Female',
        'biography' => 'My awesome biography',
    ])->computerScientist()->hasUser(1)->create()->user;

    $response = $this
        ->actingAs($user)
        ->patch('/candidate/profile', [
            'course' => 'Human Resource',
            'biography' => 'My awesome biography',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Human Resource', $user->profile->course);
    $this->assertSame('My awesome biography', $user->profile->biography);
});

test('user can delete their account', function () {
     $user = Candidate::factory([
        'name' => 'Jane Doe',
        'birthdate' => '1985-01-19',
        'gender' => 'Female',
        'biography' => 'My awesome biography',
    ])->computerScientist()->hasUser(1)->create()->user;

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrors('password')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});
