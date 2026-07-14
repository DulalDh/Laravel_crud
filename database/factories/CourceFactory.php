<?php

namespace Database\Factories;

use App\Models\Cource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cource>
 */
class CourceFactory extends Factory
{
    protected $model = Cource::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->optional()->paragraph(),
        ];
    }
}
