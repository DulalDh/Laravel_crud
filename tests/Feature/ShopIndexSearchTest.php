<?php

use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('filters shops by search term', function () {
    Shop::factory()->create([
        'shop_name' => 'Dinajpur Hardware',
        'tin_number' => 'TIN10001',
    ]);
    Shop::factory()->create([
        'shop_name' => 'Dhaka Stationery',
        'tin_number' => 'TIN10002',
    ]);

    get(route('shop.index', ['search' => 'Hardware']))
        ->assertOk()
        ->assertSee('Dinajpur Hardware')
        ->assertDontSee('Dhaka Stationery')
        ->assertSee('value="Hardware"', false);
});
