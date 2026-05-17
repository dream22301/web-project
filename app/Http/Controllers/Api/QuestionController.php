<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuestionSet;
use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function findByKey(Request $request, string $keyCode)
    {
        $request->validate([
            'nis'      => 'required|string',
            'password' => 'required|string',
        ]);

        $student = Student::where('nis', $request->nis)->first();

        if (! $student || ! Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'Autentikasi gagal. Silakan login kembali.'], 401);
        }

        $set = QuestionSet::with('questions')
            ->where('key_code', $keyCode)
            ->first();

        if (! $set) {
            return response()->json(['message' => 'Kode soal tidak ditemukan. Periksa kembali kode yang kamu masukkan.'], 404);
        }

        if ($set->is_one_time) {
            $hasScore = StudentScore::where('student_id', $student->id)
                ->where('question_set_id', $set->id)
                ->exists();

            if ($hasScore) {
                return response()->json(['message' => 'Kamu sudah mengerjakan paket soal ini dan tidak dapat mengulangnya.'], 403);
            }
        }

        return response()->json($this->formatSet($set));
    }

    /**
     * POST /api/mobile/questions/{id}/score
     * Submits the student's score for the given question set.
     */
    public function submitScore(Request $request, int $id)
    {
        $request->validate([
            'nis'      => 'required|string',
            'password' => 'required|string',
            'score'    => 'required|numeric',
        ]);

        $student = Student::where('nis', $request->nis)->first();

        if (! $student || ! Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'Autentikasi gagal. Silakan login kembali.'], 401);
        }

        $set = QuestionSet::find($id);
        if (! $set) {
            return response()->json(['message' => 'Paket soal tidak ditemukan.'], 404);
        }

        $existingScore = StudentScore::where('student_id', $student->id)
            ->where('question_set_id', $set->id)
            ->first();

        if ($set->is_one_time && $existingScore) {
            return response()->json(['message' => 'Kamu sudah mengerjakan paket soal ini dan tidak dapat mengulangnya.'], 403);
        }

        if ($existingScore) {
            $existingScore->update(['score' => $request->score]);
        } else {
            StudentScore::create([
                'student_id'      => $student->id,
                'question_set_id' => $set->id,
                'score'           => $request->score,
            ]);
        }

        return response()->json(['message' => 'Skor berhasil disimpan.']);
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
