<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionSet;
use Illuminate\Database\Seeder;

class QuestionSetSeeder extends Seeder
{
    public function run(): void
    {
        $quizTitles = [
            'Quiz Matematika Bab 1 - Aljabar',
            'Quiz Bahasa Indonesia - Puisi',
            'Quiz Sejarah Indonesia - Kemerdekan',
            'Quiz PKN - Negara Hukum',
            'Quiz Matematika Bab 2 - Geometri',
            'Quiz Bahasa Inggris - Daily Conversation',
            'Ujian Tengah Semester Ganjil',
            'Ujian Akhir Semester Genap',
        ];

        $userId = 1;

        foreach ($quizTitles as $title) {
            $questionSet = QuestionSet::create([
                'user_id' => $userId,
                'title' => $title,
                'key_code' => strtoupper(substr($title, 0, 3)).rand(100, 999),
            ]);

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
            ];

            foreach ($questions as $q) {
                Question::create([
                    'question_set_id' => $questionSet->id,
                    'question_text' => $q['text'],
                    'option_a' => $q['a'],
                    'option_b' => $q['b'],
                    'option_c' => $q['c'],
                    'option_d' => $q['d'],
                    'correct_answer' => $q['correct'],
                ]);
            }
        }
    }
}
