<?php

use App\Models\customer;
use App\Models\CustomerDetail;
use App\Models\Shop;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('seeds twenty shops and customers', function () {
    $this->seed(DatabaseSeeder::class);

    expect(Shop::query()->count())->toBe(20)
        ->and(customer::query()->count())->toBe(20)
        ->and(CustomerDetail::query()->count())->toBe(20);
});
