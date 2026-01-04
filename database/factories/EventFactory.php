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
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'event_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'venue' => $this->faker->address(),
            'category_id' => \App\Models\Category::factory(),
            'event_picture' => $this->faker->imageUrl(640, 480, 'events', true),
            'capacity' => $this->faker->numberBetween(50, 1000),
            'status' => $this->faker->randomElement(['upcoming', 'ongoing', 'completed', 'cancelled']),
        ];
    }
}
