<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'item_name' => fake()->name(),
            'slug' => fake()->slug(5, false),
            'description' =>fake()->text(300),
            'amount' => fake()->numberBetween(50000, 20000),
            'discount' => fake()->numberBetween(0, 5),
            'picture' => '/assets/images/product/large-size/'.  fake()->unique(true)->randomDigit() .'.jpg'
        ];
    }
}
