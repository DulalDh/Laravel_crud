<?php

namespace Database\Factories;

use App\Models\CustomerDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CustomerDetail>
 */
class CustomerDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->streetAddress(),
            'dob' => fake()->date(),
        ];
    }
}
