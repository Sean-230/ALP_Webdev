<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = fake()->time('H:i:s');
        $endTime = fake()->time('H:i:s', strtotime($startTime . ' +2 hours'));
        
        return [
            'event_id' => \App\Models\Event::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
