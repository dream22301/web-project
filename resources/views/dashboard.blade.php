@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Welcome back! Here's a quick overview of today.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">

        <!-- Stat Card 1 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="shrink-0 bg-blue-50 dark:bg-blue-900/40 p-3 rounded-md">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Users</dt>
                        <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $totalUsers }}</dd>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="shrink-0 bg-green-50 dark:bg-green-900/40 p-3 rounded-md">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Schedules</dt>
                        <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $totalSchedules }}</dd>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="shrink-0 bg-yellow-50 dark:bg-yellow-900/40 p-3 rounded-md">
                        <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Announcements</dt>
                        <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $totalAnnouncements }}</dd>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="shrink-0 bg-purple-50 dark:bg-purple-900/40 p-3 rounded-md">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Questions</dt>
                        <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $totalQuestions }}</dd>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Activities -->
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">

        <!-- Today Announcements -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Today's Announcements</h3>
            </div>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($todayAnnouncements as $announcement)
                    <li class="p-5">
                        <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-900/40 p-3 rounded-md">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $announcement->title }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ Str::limit($announcement->content, 50) }}</p>
                            </div>
                            <span class="inline-flex items-center rounded-full {{ $announcement->prioritas === 'urgent' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' }} px-2.5 py-0.5 text-xs font-medium">
                                {{ ucfirst($announcement->priority_label ?? $announcement->prioritas) }}
                            </span>
                        </div>
                    </li>
                @empty
                    <li class="p-5 text-center text-sm text-gray-500 dark:text-gray-400">
                        No announcements for today.
                    </li>
                @endforelse
            </ul>
        </div>

        <!-- Now Schedules -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Now Schedules</h3>
            </div>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($nowSchedules as $schedule)
                    <li class="p-5">
                        <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-900/40 p-3 rounded-md">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $schedule->subject }} - {{ $schedule->class }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Jam pelajaran ke-{{ $schedule->start_time }}
                                    @if($schedule->end_time)
                                        sampai ke-{{ $schedule->end_time }}
                                    @endif
                                </p>
                            </div>
                            <div class="shrink-0 bg-green-50 dark:bg-green-900/40 p-2 rounded-md">
                                <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="p-5 text-center text-sm text-gray-500 dark:text-gray-400">
                        No upcoming schedules for today.
                    </li>
                @endforelse
            </ul>
        </div>

    </div>

@endsection
