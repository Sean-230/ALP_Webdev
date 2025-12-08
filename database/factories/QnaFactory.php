<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Qna>
 */
class QnaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hasAnswer = fake()->boolean(60);
        
        return [
            'event_id' => \App\Models\Event::factory(),
            'user_id' => \App\Models\User::factory(),
            'question' => fake()->sentence() . '?',
            'answer' => $hasAnswer ? fake()->paragraph() : null,
            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'answered_at' => $hasAnswer ? fake()->dateTimeBetween('-1 month', 'now') : null,
        ];
    }
}
