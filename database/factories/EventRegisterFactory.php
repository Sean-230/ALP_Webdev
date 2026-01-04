<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventRegister>
 */
class EventRegisterFactory extends Factory
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
            'event_id' => \App\Models\Event::factory(),
            'ticket_qty' => $this->faker->numberBetween(1, 10),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'payment_proof' => $this->faker->optional(0.7)->imageUrl(400, 600, 'business', true),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
