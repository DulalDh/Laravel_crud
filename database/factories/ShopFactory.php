<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_name' => $this->faker->company(),
            'shop_number' => $this->faker->unique()->randomNumber(5),
            'shop_address' => $this->faker->address(),
            'shop_phone' => $this->faker->phoneNumber(),
            'shop_email' => $this->faker->unique()->safeEmail(),
            'tin_number' => $this->faker->numerify('TIN#####'),
        ];
    }
}
