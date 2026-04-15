<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentSchedule>
 */
class StudentScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day' => fake()->randomElement([
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
            ]),
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
        ];
    }
}
