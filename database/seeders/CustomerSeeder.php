<?php

namespace Database\Seeders;

use App\Models\customer;
use App\Models\CustomerDetail;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        customer::factory()
            ->count(20)
            ->create()
            ->each(function (customer $customer): void {
                CustomerDetail::factory()->for($customer)->create();
            });
    }
}
