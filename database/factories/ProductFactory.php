<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->name(),
            'price'=>floatval(fake()->numberBetween(1,20)),
            'quantity'=>fake()->numberBetween(1,5),
            'height'=>fake()->numberBetween(10,20),
            'width'=>fake()->numberBetween(10,20),
            'weight'=>fake()->numberBetween(10,20),
            'depth'=>fake()->numberBetween(10,20),
        ];
    }
}
