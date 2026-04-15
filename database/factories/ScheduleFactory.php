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

        $start_time = fake()->numberBetween(1, 12);

        return [
            'user_id' => 1,
            'subject' => fake()->randomElement([
                'Konsen RPL',
                'Bahasa Indonesia',
                'Bahasa Inggris',
                'Matematika',
                'Kewirausahaan',
                'Pendidikan Jasmani olahraga dan kesehatan',
                'Desain Grafis',
                'Bimbingan konseling',
                'Sejarah',
                'Pendidikan Pancasila',
                'Bahasa Jawa',
                'Pendidikan Agama dan Budi Pekerti',
            ]),
            'class' => fake()->randomElement([
                'X - RPL',
                'XI - RPL',
                'XII - RPL',
            ]),
            'day' => fake()->randomElement([
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat'
            ]),
            'start_time' => $start_time,
            'end_time' => fake()->numberBetween($start_time + 1, 12),
        ];
    }
}
