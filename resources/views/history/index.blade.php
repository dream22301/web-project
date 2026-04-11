@extends('layouts.app')

@section('title', 'History Dashboard')

@section('content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Historical Records</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">View archived items older than 1 week. Edit an item to restore it.</p>
    </div>

    <!-- Alpine Tabs -->
    <div x-data="{ activeTab: 'announcements' }">
        <!-- Tab Navigation -->
        <div class="flex space-x-4 border-b border-gray-200 dark:border-gray-700 mb-6">
            <button @click="activeTab = 'announcements'"
                    :class="{ 'text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400': activeTab === 'announcements', 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'announcements' }"
                    class="py-3 px-4 border-b-2 font-medium text-sm transition-colors whitespace-nowrap">
                Announcements
                <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                    {{ $announcements->count() }}
                </span>
            </button>
            
            <button @click="activeTab = 'schedules'"
                    :class="{ 'text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400': activeTab === 'schedules', 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'schedules' }"
                    class="py-3 px-4 border-b-2 font-medium text-sm transition-colors whitespace-nowrap">
                Teacher Schedules
                <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                    {{ $schedules->flatten()->count() }}
                </span>
            </button>
            
            <button @click="activeTab = 'studentSchedules'"
                    :class="{ 'text-blue-600 border-blue-600 dark:text-blue-400 dark:border-blue-400': activeTab === 'studentSchedules', 'text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'studentSchedules' }"
                    class="py-3 px-4 border-b-2 font-medium text-sm transition-colors whitespace-nowrap">
                Student Schedules
                <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                    {{ $studentSchedules->flatten()->count() }}
                </span>
            </button>
        </div>

        <!-- Tab Contents -->
        <div class="max-w-3xl">

            <!-- Announcements Tab -->
            <div x-show="activeTab === 'announcements'" x-cloak>
                @if($announcements->isEmpty())
                    <div class="text-center py-10 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                        <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <p class="text-sm text-gray-400 dark:text-gray-500">No archived announcements.</p>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($announcements as $announcement)
                        <div class="flex items-start justify-between gap-4 px-5 py-4">
                            <div class="flex-1 min-w-0 opacity-60 hover:opacity-100 transition-opacity">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                        {{ $announcement->title }}
                                    </span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">{{ ucfirst($announcement->audience) }}</span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1">{{ $announcement->content }}</p>
                                <p class="mt-1 text-xs text-red-500 dark:text-red-400">
                                    Archived (Last updated: {{ $announcement->updated_at->diffForHumans() }})
                                </p>
                            </div>
                            <div class="shrink-0 flex items-center gap-2">
                                <a href="{{ route('announcement.edit', $announcement->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-md dark:bg-blue-900/40 dark:text-blue-400 dark:hover:bg-blue-900/60 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Restore / Edit
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Schedules Tab -->
            <div x-show="activeTab === 'schedules'" x-cloak>
                @if($schedules->isEmpty())
                    <div class="text-center py-10 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                        <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <p class="text-sm text-gray-400 dark:text-gray-500">No archived teacher schedules.</p>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $dayName)
                            @if(isset($schedules[$dayName]))
                            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                                <div class="px-5 py-3 bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase">{{ $dayName }}</h3>
                                </div>
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($schedules[$dayName]->sortBy('start_time') as $schedule)
                                    <div class="flex items-center justify-between gap-4 px-5 py-4 opacity-75 hover:opacity-100 transition-opacity">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $schedule->subject }} <span class="ml-2 font-normal text-gray-500 dark:text-gray-400">Class {{ $schedule->class }}</span></p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Period: {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                                        </div>
                                        <div class="shrink-0">
                                            <a href="{{ route('schedule.edit', $schedule->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-md dark:bg-blue-900/40 dark:text-blue-400 dark:hover:bg-blue-900/60 transition-colors">
                                                Restore / Edit
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Student Schedules Tab -->
            <div x-show="activeTab === 'studentSchedules'" x-cloak>
                @if($studentSchedules->isEmpty())
                    <div class="text-center py-10 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                        <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <p class="text-sm text-gray-400 dark:text-gray-500">No archived student schedules.</p>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $dayName)
                            @if(isset($studentSchedules[$dayName]))
                            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                                <div class="px-5 py-3 bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase">{{ $dayName }}</h3>
                                </div>
                                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($studentSchedules[$dayName]->sortBy('period_start') as $schedule)
                                    <div class="flex items-center justify-between gap-4 px-5 py-4 opacity-75 hover:opacity-100 transition-opacity">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $schedule->subject }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Room: {{ $schedule->room }} &bull; Period: {{ $schedule->period_start }} - {{ $schedule->period_end }}</p>
                                        </div>
                                        <div class="shrink-0">
                                            <a href="{{ route('student-schedule.edit', $schedule->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-md dark:bg-blue-900/40 dark:text-blue-400 dark:hover:bg-blue-900/60 transition-colors">
                                                Restore / Edit
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection
