@extends('layouts.app')

@section('title', 'Schedule Management')

@section('content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Schedule Management</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a new class schedule for your students.</p>
    </div>

    <!-- Main Content Card -->
    <div class="max-w-3xl bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors">

        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Add New Schedule</h3>
        </div>

        <form action="#" method="POST" class="p-6 sm:p-8">

            <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                    <select id="subject" name="subject"
                            class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                        <option value="">Select subject...</option>
                        <option>Mathematics</option>
                        <option>Physics</option>
                        <option>Biology</option>
                        <option>English Literature</option>
                        <option>History</option>
                    </select>
                </div>

                <!-- Class -->
                <div>
                    <label for="class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Class</label>
                    <select id="class" name="class"
                            class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                        <option value="">Select class...</option>
                        <option>X - Science 1</option>
                        <option>X - Science 2</option>
                        <option>XI - Social 1</option>
                        <option>XII - Science 1</option>
                    </select>
                </div>

                <!-- Day Selection -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Day</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                        <div class="flex items-center">
                            <input id="day-{{ strtolower($day) }}" name="day" type="radio" value="{{ $day }}"
                                   class="h-4 w-4 border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-600 dark:bg-gray-700">
                            <label for="day-{{ strtolower($day) }}" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $day }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Start Time -->
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Time</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input type="time" id="start_time" name="start_time"
                               class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                    </div>
                </div>

                <!-- End Time -->
                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Time</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input type="time" id="end_time" name="end_time"
                               class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                    </div>
                </div>

            </div>

            <!-- Actions -->
            <div class="mt-8 flex items-center justify-end gap-3">
                <a href="{{ url('/') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex justify-center items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Submit Schedule
                </button>
            </div>

        </form>
    </div>

@endsection
