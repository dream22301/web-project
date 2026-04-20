<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionSetFactory extends Factory
{
    public function definition(): array
    {
        $titles = [
            'Quiz Matematika Bab 1',
            'Quiz Bahasa Indonesia',
            'Quiz Sejarah Indonesia',
            'Quiz PKN',
            'Quiz Matematika Bab 2',
            'Quiz Bahasa Inggris',
            'Ujian Tengah Semester',
            'Ujian Akhir Semester',
        ];

        return [
            'user_id' => 1,
            'title' => fake()->randomElement($titles),
            'key_code' => strtoupper(fake()->unique()->bothify('????###')),
        ];
    }
}
