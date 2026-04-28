@extends('layouts.app')

@section('title', 'Questions')

@section('content')

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 text-sm font-medium">
        <svg class="w-5 h-5 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Edit Question Set Modal --}}
    @if(isset($editingSet))
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Edit Question Set</h3>
                <a href="{{ route('questions.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </div>
            <form action="{{ route('questions.update', $editingSet->id) }}" method="POST" class="p-6 sm:p-8 space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Set Title</label>
                    <input type="text" id="edit_title" name="title" value="{{ $editingSet->title }}" required
                           class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm">
                </div>
                <div>
                    <label for="edit_key_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Key Code</label>
                    <input type="text" id="edit_key_code" name="key_code" value="{{ $editingSet->key_code }}"
                           class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm font-mono">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('questions.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition-colors">Cancel</a>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Questions</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Create question sets with a key code, then add questions to each set.</p>
    </div>

    {{-- Create Key Form --}}
    <div class="max-w-3xl bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-10 transition-colors">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Create New Question Set</h3>
        </div>
        <form action="{{ route('questions.store') }}" method="POST" class="p-6 sm:p-8 space-y-5">
            @csrf

            @if($errors->any())
            <div class="flex items-start gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-300 text-sm">
                <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
            @endif

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Set Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Mid-Term Mathematics 2026"
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                              {{ $errors->has('title') ? 'ring-red-400 dark:ring-red-500' : '' }}">
                @error('title') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Key Code --}}
            <div>
                <label for="key_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Key Code
                    <span class="ml-1 text-xs font-normal text-gray-400 dark:text-gray-500">(leave blank to auto-generate)</span>
                </label>
                <div class="flex gap-3 items-start">
                    <div class="flex-1">
                        <input type="text" id="key_code" name="key_code" value="{{ old('key_code') }}" placeholder="e.g. MATH-2026 — or leave blank for random"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors font-mono
                                      {{ $errors->has('key_code') ? 'ring-red-400 dark:ring-red-500' : '' }}">
                        @error('key_code') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-2 flex gap-4 text-xs text-gray-400 dark:text-gray-500">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Manual: type your own
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Random: leave blank to auto-generate
                    </span>
                </div>
            </div>

            <div class="flex justify-end pt-1">
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Set
                </button>
            </div>
        </form>
    </div>

    {{-- Question Sets List --}}
    <div class="max-w-3xl" id="question-list">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Your Question Sets</h2>
                <span class="text-sm text-gray-400 dark:text-gray-500">{{ $questionSets->total() }} total</span>
            </div>

            <!-- Search Bar -->
            <form action="{{ route('questions.index') }}" method="GET" class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="block w-full pl-10 pr-3 py-2 border border-gray-200 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 sm:text-sm transition-colors"
                       placeholder="Search sets...">
            </form>
        </div>

        @if($questionSets->isEmpty())
        <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
            <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-sm text-gray-400 dark:text-gray-500">No question sets yet. Create your first one above.</p>
        </div>
        @else
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden divide-y divide-gray-100 dark:divide-gray-700">
            @foreach($questionSets as $set)
            <div class="flex items-center justify-between gap-4 px-5 py-4">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-0.5">
                        <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $set->title }}</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-mono font-medium bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300">
                            {{ $set->key_code }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ $set->questions_count }} question{{ $set->questions_count !== 1 ? 's' : '' }} · Created {{ $set->created_at->format('d M Y') }}</p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('questions.index', ['edit' => $set->id]) }}"
                       class="p-1.5 rounded-md text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 dark:hover:text-yellow-400 dark:hover:bg-yellow-900/30 transition-colors" title="Edit set">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <a href="{{ route('questions.show', $set->id) }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                        Manage
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <form action="{{ route('questions.destroy', $set->id) }}" method="POST" onsubmit="return confirm('Delete this question set and all its questions?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:text-red-400 dark:hover:bg-red-900/30 transition-colors" title="Delete set">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            {{ $questionSets->links() }}
        </div>
        @endif
    </div>

@endsection
