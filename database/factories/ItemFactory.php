<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = fake()->numberBetween(1, 100)/10;
        $quantity = fake()->numberBetween(1, 100);
        return [
            "unit_price"=> $price,
            "quantity" => $quantity,
            "amount" => $price * $quantity,
            "description" => fake()->word,
        ];
    }
}
