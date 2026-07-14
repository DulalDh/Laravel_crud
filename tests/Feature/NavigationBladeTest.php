<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('highlights the home navbar item on the home page', function (): void {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('nav-link active', false);
    $response->assertSee(route('home'), false);
});

it('highlights the customer navbar item on the customer index page and renders a back button', function (): void {
    $response = $this->get(route('customer.index'));

    $response->assertOk();
    $response->assertSee('nav-link active fw-semibold', false);
    $response->assertSee('data-back-button', false);
});
