<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(3),
            'event_date' => fake()->dateTimeBetween('now', '+6 months'),
            'venue' => fake()->address(),
            'category_id' => \App\Models\Category::factory(),
            'event_picture' => fake()->imageUrl(640, 480, 'events', true),
            'capacity' => fake()->numberBetween(50, 1000),
            'status' => fake()->randomElement(['upcoming', 'ongoing', 'completed', 'cancelled']),
        ];
    }
}
