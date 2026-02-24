@extends('layouts.app')

@section('title', 'Announcement')

@section('content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Announcements</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Create and publish announcements for your students.</p>
    </div>

    <!-- Form Card -->
    <div class="max-w-3xl bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors">

        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">New Announcement</h3>
        </div>

        <form action="#" method="POST" class="p-6 sm:p-8 space-y-6">

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Title
                </label>
                <input type="text" id="title" name="title" placeholder="e.g. School Holiday Notice"
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
            </div>

            <!-- Target Audience -->
            <div>
                <label for="audience" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Target Audience
                </label>
                <select id="audience" name="audience"
                        class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                    <option value="">Select audience...</option>
                    <option value="all">All Students</option>
                    <option value="x">Grade X</option>
                    <option value="xi">Grade XI</option>
                    <option value="xii">Grade XII</option>
                </select>
            </div>

            <!-- Priority -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Priority</label>
                <div class="flex flex-wrap gap-4">
                    @foreach([
                        ['value' => 'normal',  'label' => 'Normal',  'color' => 'text-gray-600 dark:text-gray-300'],
                        ['value' => 'info',    'label' => 'Info',    'color' => 'text-blue-600 dark:text-blue-400'],
                        ['value' => 'warning', 'label' => 'Warning', 'color' => 'text-amber-600 dark:text-amber-400'],
                        ['value' => 'urgent',  'label' => 'Urgent',  'color' => 'text-red-600 dark:text-red-400'],
                    ] as $p)
                    <div class="flex items-center">
                        <input id="priority-{{ $p['value'] }}" name="priority" type="radio" value="{{ $p['value'] }}"
                               class="h-4 w-4 border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-600 dark:bg-gray-700"
                               {{ $p['value'] === 'normal' ? 'checked' : '' }}>
                        <label for="priority-{{ $p['value'] }}" class="ml-2 text-sm font-medium {{ $p['color'] }}">
                            {{ $p['label'] }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Content
                </label>
                <textarea id="content" name="content" rows="6"
                          placeholder="Write your announcement here..."
                          class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors resize-none"></textarea>
            </div>

            <!-- Publish Date -->
            <div>
                <label for="publish_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Publish Date
                </label>
                <div class="relative max-w-xs">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input type="date" id="publish_date" name="publish_date"
                           class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ url('/') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex justify-center items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Publish Announcement
                </button>
            </div>

        </form>
    </div>

@endsection