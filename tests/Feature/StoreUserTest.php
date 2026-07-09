<?php

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('shows the store form', function () {
    get(route('store.form'))
        ->assertOk()
        ->assertSee('Store User Data');
});

it('stores user in session and redirects', function () {
    post(route('store'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '123456',
    ])->assertRedirect(route('store.form'));

    expect(session('users'))
        ->toBeArray()
        ->toHaveCount(1);

    expect(session('users')[0])
        ->toMatchArray([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '123456',
        ]);

    get(route('store.form'))
        ->assertSee('Test User')
        ->assertSee('test@example.com')
        ->assertSee('123456');
});
