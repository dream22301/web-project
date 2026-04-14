<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(10),
            'audience' => fake()->randomElement(['all', 'x', 'xi', 'xii']),
            'prioritas' => fake()->randomElement(array_keys(Announcement::PRIORITY)),
            'content' => fake()->paragraphs(2, true),
            'publish_date' => fake()->dateTimeBetween('-1 week', '+1 week'),
        ];
    }
}
