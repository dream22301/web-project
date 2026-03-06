@extends('layouts.app')

@section('title', $set->title . ' — Questions')

@section('content')

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 text-sm font-medium">
        <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Page Header --}}
    <div class="mb-8">
        <a href="{{ route('questions.index') }}" class="text-sm text-gray-400 dark:text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
            ← All Sets
        </a>
        <h1 class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $set->title }}</h1>
        <div class="mt-2 flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-mono font-semibold bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
                {{ $set->key_code }}
            </span>
            <span class="text-sm text-gray-400 dark:text-gray-500">{{ $set->questions->count() }} question{{ $set->questions->count() !== 1 ? 's' : '' }}</span>
        </div>
    </div>

    <div class="max-w-3xl space-y-8">

        {{-- Add Question Form --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Add a Multiple Choice Question</h3>
            </div>
            <form action="{{ route('questions.addQuestion', $set->id) }}" method="POST" class="p-6 sm:p-8 space-y-5">
                @csrf

                @if($errors->any())
                <div class="flex items-start gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-300 text-sm">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
                @endif

                {{-- Question Text --}}
                <div>
                    <label for="question_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Question</label>
                    <textarea id="question_text" name="question_text" rows="3"
                              placeholder="Type your question here..."
                              class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors resize-none
                                     {{ $errors->has('question_text') ? 'ring-red-400 dark:ring-red-500' : '' }}">{{ old('question_text') }}</textarea>
                    @error('question_text') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- Answer Options --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Answer Options</label>
                    <div class="space-y-3">
                        @foreach(['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $key => $label)
                        <div class="flex items-center gap-3">
                            {{-- Option letter badge --}}
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm font-bold flex items-center justify-center">
                                {{ $label }}
                            </span>
                            <input type="text" name="option_{{ $key }}" value="{{ old('option_' . $key) }}"
                                   placeholder="Option {{ $label }}..."
                                   class="flex-1 rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                          {{ $errors->has('option_' . $key) ? 'ring-red-400 dark:ring-red-500' : '' }}">
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Correct Answer --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Correct Answer</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach(['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $key => $label)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="correct_answer" value="{{ $key }}"
                                   {{ old('correct_answer') === $key ? 'checked' : '' }}
                                   class="h-4 w-4 border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-600 dark:bg-gray-700">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Option {{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('correct_answer') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-1">
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Question
                    </button>
                </div>
            </form>
        </div>

        {{-- Questions List --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Questions in this Set</h2>

            @if($set->questions->isEmpty())
            <div class="text-center py-10 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-gray-400 dark:text-gray-500">No questions yet. Add your first one above.</p>
            </div>
            @else
            <div class="space-y-4">
                @foreach($set->questions as $index => $question)
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-colors">
                    {{-- Question header --}}
                    <div class="flex items-start justify-between gap-4 px-5 py-4 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-start gap-3 flex-1">
                            <span class="flex-shrink-0 w-7 h-7 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 text-xs font-bold flex items-center justify-center mt-0.5">
                                {{ $index + 1 }}
                            </span>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 leading-relaxed">{{ $question->question_text }}</p>
                        </div>
                        <form action="{{ route('questions.destroyQuestion', [$set->id, $question->id]) }}" method="POST"
                              onsubmit="return confirm('Delete this question?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="flex-shrink-0 p-2 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:text-red-400 dark:hover:bg-red-900/30 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    {{-- Options --}}
                    <div class="px-5 py-3 grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach(['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d] as $key => $text)
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm
                                    {{ $question->correct_answer === $key
                                        ? 'bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700'
                                        : 'bg-gray-50 dark:bg-gray-700/50' }}">
                            <span class="flex-shrink-0 w-6 h-6 rounded-md text-xs font-bold flex items-center justify-center
                                         {{ $question->correct_answer === $key
                                            ? 'bg-green-500 text-white'
                                            : 'bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300' }}">
                                {{ strtoupper($key) }}
                            </span>
                            <span class="{{ $question->correct_answer === $key ? 'text-green-800 dark:text-green-200 font-medium' : 'text-gray-600 dark:text-gray-300' }}">
                                {{ $text }}
                            </span>
                            @if($question->correct_answer === $key)
                            <svg class="w-4 h-4 ml-auto text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>

@endsection
