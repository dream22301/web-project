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
     * Returns a single question set with all its questions (shuffled options).
     */
    public function show(int $id)
    {
        $set = QuestionSet::with('questions')->find($id);

        if (! $set) {
            return response()->json(['message' => 'Paket soal tidak ditemukan.'], 404);
        }

        $questions = $set->questions->map(fn ($q) => [
            'id'             => $q->id,
            'question_text'  => $q->question_text,
            'option_a'       => $q->option_a,
            'option_b'       => $q->option_b,
            'option_c'       => $q->option_c,
            'option_d'       => $q->option_d,
            'correct_answer' => $q->correct_answer,
        ]);

        return response()->json([
            'id'        => $set->id,
            'title'     => $set->title,
            'key_code'  => $set->key_code,
            'questions' => $questions,
        ]);
    }
}
