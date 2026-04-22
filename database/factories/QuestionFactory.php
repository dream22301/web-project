<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition(): array
    {
        $questions = [
            [
                'text' => 'Berapakah hasil dari 15 + 27?',
                'a' => '40', 'b' => '42', 'c' => '41', 'd' => '43',
                'correct' => 'b',
            ],
            [
                'text' => 'Apa ibu kota dari Indonesia?',
                'a' => 'Bandung', 'b' => 'Jakarta', 'c' => 'Surabaya', 'd' => 'Medan',
                'correct' => 'b',
            ],
            [
                'text' => 'Siapa president pertama Indonesia?',
                'a' => 'Soekarno', 'b' => 'Soeharto', 'c' => 'Habibie', 'd' => 'Gus Dur',
                'correct' => 'a',
            ],
            [
                'text' => 'Berapakah 8 x 7?',
                'a' => '54', 'b' => '56', 'c' => '58', 'd' => '52',
                'correct' => 'b',
            ],
            [
                'text' => 'Apa bahasa inggris dari "buku"?',
                'a' => 'Book', 'b' => 'Boook', 'c' => 'Buku', 'd' => 'Buck',
                'correct' => 'a',
            ],
            [
                'text' => 'Berapakah akar kuadrat dari 144?',
                'a' => '10', 'b' => '11', 'c' => '12', 'd' => '13',
                'correct' => 'c',
            ],
            [
                'text' => 'Dalam alphabet, berapa jumlah huruf?',
                'a' => '24', 'b' => '25', 'c' => '26', 'd' => '27',
                'correct' => 'c',
            ],
            [
                'text' => 'Air mendidih pada suhu berapa derajat?',
                'a' => '90°C', 'b' => '95°C', 'c' => '100°C', 'd' => '105°C',
                'correct' => 'c',
            ],
        ];

        $q = fake()->randomElement($questions);

        return [
            'question_text' => $q['text'],
            'option_a' => $q['a'],
            'option_b' => $q['b'],
            'option_c' => $q['c'],
            'option_d' => $q['d'],
            'correct_answer' => $q['correct'],
        ];
    }
}
