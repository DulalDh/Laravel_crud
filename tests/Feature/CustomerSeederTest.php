<?php

use App\Models\customer;
use App\Models\CustomerDetail;
use Database\Seeders\CustomerSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a customer detail for every seeded customer', function () {
    $this->seed(CustomerSeeder::class);

    expect(customer::query()->count())->toBe(20)
        ->and(CustomerDetail::query()->count())->toBe(20);
});
