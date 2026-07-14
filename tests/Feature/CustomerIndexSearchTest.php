<?php

use App\Models\customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('filters customers by search term and shows the modern action controls', function () {
    customer::factory()->create([
        'name' => 'Rahim Uddin',
        'email' => 'rahim@example.com',
        'phone' => '01711111111',
    ]);
    customer::factory()->create([
        'name' => 'Karim Uddin',
        'email' => 'karim@example.com',
        'phone' => '01822222222',
    ]);

    get(route('customer.index', ['search' => 'Rahim']))
        ->assertOk()
        ->assertSee('Add New')
        ->assertSee('Search customers')
        ->assertSee('Rahim Uddin')
        ->assertDontSee('Karim Uddin')
        ->assertSee('value="Rahim"', false);
});
