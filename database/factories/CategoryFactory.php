<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Music Concert' => 'images/Music_Concert.jpg',
            'Tech Conference' => 'images/Tech_Conference.jpeg',
            'Art Exhibition' => 'images/Art_Exhibition.jpg',
            'Food Festival' => 'images/Food_Festival.jpg',
            'Sports Event' => 'images/Sport_Event.jpg',
            'Theater Show' => 'images/Theatre_Show.jpg',
            'Workshop' => 'images/Workshop.jpeg',
            'Networking Event' => 'images/Networking_Event.png',
            'Charity Event' => 'images/Charity_Event.png',
            'Trade Show' => 'images/Trade_Show.jpg'
        ];

        $categoryName = $this->faker->unique()->randomElement(array_keys($categories));

        return [
            'name' => $categoryName,
            'image' => $categories[$categoryName],
        ];
    }
}
