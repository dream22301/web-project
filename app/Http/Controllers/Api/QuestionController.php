<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuestionSet;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * GET /api/mobile/questions
     * Returns all question sets (title, key_code, question count).
     */
    public function index()
    {
        $sets = QuestionSet::withCount('questions')->latest()->get();

        return response()->json($sets->map(fn ($s) => [
            'id'             => $s->id,
            'title'          => $s->title,
            'key_code'       => $s->key_code,
            'questions_count'=> $s->questions_count,
        ]));
    }

    /**
     * GET /api/mobile/questions/{id}
     * Returns a single question set with all its questions.
     */
    public function show(int $id)
    {
        $set = QuestionSet::with('questions')->find($id);

        if (! $set) {
            return response()->json(['message' => 'Paket soal tidak ditemukan.'], 404);
        }

        return response()->json($this->formatSet($set));
    }

    /**
     * GET /api/mobile/questions/key/{key_code}
     * Finds a question set by its key_code.
     * Returns 404 with a message if the key is invalid.
     */
    public function findByKey(string $keyCode)
    {
        $set = QuestionSet::with('questions')
            ->where('key_code', $keyCode)
            ->first();

        if (! $set) {
            return response()->json(['message' => 'Kode soal tidak ditemukan. Periksa kembali kode yang kamu masukkan.'], 404);
        }

        return response()->json($this->formatSet($set));
    }

    /**
     * Shared formatter for a QuestionSet with its questions.
     */
    private function formatSet(QuestionSet $set): array
    {
        $questions = $set->questions->map(fn ($q) => [
            'id'             => $q->id,
            'question_text'  => $q->question_text,
            'option_a'       => $q->option_a,
            'option_b'       => $q->option_b,
            'option_c'       => $q->option_c,
            'option_d'       => $q->option_d,
            'correct_answer' => $q->correct_answer,
        ]);

        return [
            'id'        => $set->id,
            'title'     => $set->title,
            'key_code'  => $set->key_code,
            'questions' => $questions,
        ];
    }
}
