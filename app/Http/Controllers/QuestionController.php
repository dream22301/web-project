<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /** List only the logged-in user's question sets */
    public function index()
    {
        $questionSets = QuestionSet::where('user_id', Auth::id())
            ->withCount('questions')
            ->latest()
            ->get();

        return view('questions.index', compact('questionSets'));
    }

    /** Create a new question set owned by the logged-in user */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|min:3|max:100',
            'key_code' => 'nullable|string|max:50|unique:question_sets,key_code',
        ]);

        $keyCode = $request->filled('key_code')
            ? strtoupper(trim($request->key_code))
            : strtoupper(Str::random(4));

        QuestionSet::create([
            'user_id'  => Auth::id(),
            'title'    => $request->title,
            'key_code' => $keyCode,
        ]);

        return redirect()->route('questions.index')
            ->with('success', 'Question set created with key: ' . $keyCode);
    }

    /** Show a question set — only if it belongs to the logged-in user */
    public function show($id)
    {
        $set = QuestionSet::where('user_id', Auth::id())
            ->with('questions')
            ->findOrFail($id);

        return view('questions.show', compact('set'));
    }

    /** Add a question to a set — owner only */
    public function addQuestion(Request $request, $id)
    {
        $set = QuestionSet::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'question_text'  => 'required|string|min:5',
            'option_a'       => 'required|string|max:255',
            'option_b'       => 'required|string|max:255',
            'option_c'       => 'required|string|max:255',
            'option_d'       => 'required|string|max:255',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        Question::create([
            'question_set_id' => $set->id,
            'question_text'   => $request->question_text,
            'option_a'        => $request->option_a,
            'option_b'        => $request->option_b,
            'option_c'        => $request->option_c,
            'option_d'        => $request->option_d,
            'correct_answer'  => $request->correct_answer,
        ]);

        return redirect()->route('questions.show', $id)
            ->with('success', 'Question added!');
    }

    /** Delete a specific question — owner only */
    public function destroyQuestion($id, $qid)
    {
        // Verify the set belongs to the logged-in user first
        $set = QuestionSet::where('user_id', Auth::id())->findOrFail($id);

        $question = Question::where('question_set_id', $set->id)->findOrFail($qid);
        $question->delete();

        return redirect()->route('questions.show', $id)
            ->with('success', 'Question deleted.');
    }

    /** Delete an entire question set — owner only */
    public function destroy($id)
    {
        QuestionSet::where('user_id', Auth::id())->findOrFail($id)->delete();

        return redirect()->route('questions.index')
            ->with('success', 'Question set deleted.');
    }
}
