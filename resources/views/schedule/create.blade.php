@extends('layouts.app')

@section('title', 'Schedule Management')

@section('content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Schedule Management</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a new class schedule for your students.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <!-- Left Column: Active Content & Form -->
        <div class="flex-1 w-full lg:max-w-3xl">
            <!-- Main Content Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors">

                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Add New Schedule</h3>
                </div>

                <form action="{{ route('schedule-create') }}" method="POST" class="p-6 sm:p-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                            <select id="subject" name="subject"
                                    class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                                <option value="">Select subject...</option>
                                <option>Konsen RPL</option>
                                <option>Bahasa Indonesia</option>
                                <option>Bahasa Inggris</option>
                                <option>Matematika</option>
                                <option>Kewirausahaan</option>
                                <option>Pendidikan Jasmani olahraga dan kesehatan</option>
                                <option>Desain Grafis</option>
                                <option>Bimbingan konseling</option>
                                <option>Sejarah</option>
                                <option>Pendidikan Pancasila</option>
                                <option>Bahasa Jawa</option>
                                <option>Pendidikan Agama dan Budi Pekerti</option>
                            </select>
                        </div>

                        <!-- Class -->
                        <div>
                            <label for="class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Class</label>
                            <select id="class" name="class"
                                    class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                                <option value="">Select class...</option>
                                <option>X - RPL</option>
                                <option>XI - RPL</option>
                                <option>XII - RPL</option>
                            </select>
                        </div>

                        <!-- Day Selection -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Day</label>
                            <div class="flex flex-wrap gap-4">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
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
                                <input type="number" id="start_time" name="start_time" placeholder="1" min="1" max="12"
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
                                <input type="number" id="end_time" name="end_time" placeholder="4" min="1" max="12"
                                       class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                            </div>
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="mt-8 flex items-center justify-end gap-3">
                        <button type="submit"
                                class="inline-flex justify-center items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Submit Schedule
                        </button>
                    </div>

                </form>
            </div>

            {{-- Schedules List --}}
            <div class="mt-8 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Published Schedules</h2>
                        <span class="text-sm text-gray-400 dark:text-gray-500">{{ $schedules->total() }} active</span>
                    </div>

                    <!-- Search Bar -->
                    <form action="{{ url('/schedule') }}" method="GET" class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-200 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 sm:text-sm transition-colors"
                               placeholder="Search schedules...">
                    </form>
                </div>

                @if($schedules->isEmpty())
                    <div class="text-center py-10 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                        <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-gray-400 dark:text-gray-500">No active schedules. Create your first one above.</p>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($schedules as $schedule)
                        <div class="flex items-start justify-between gap-4 px-5 py-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                        {{ $schedule->subject }}
                                    </span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400">
                                        {{ $schedule->class }}
                                    </span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">{{ $schedule->day }}</span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Jam pelajaran ke-{{ $schedule->start_time }} sampai jam pelajaran ke-{{ $schedule->end_time }}
                                </p>
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-2">
                                <a href="{{ route('schedule.edit', $schedule->id) }}"
                                   class="shrink-0 p-2 rounded-md text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:text-blue-400 dark:hover:bg-blue-900/30 transition-colors"
                                   title="Edit schedule">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this schedule?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="shrink-0 p-2 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:text-red-400 dark:hover:bg-red-900/30 transition-colors"
                                            title="Delete schedule">
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
                        {{ $schedules->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: History Panel -->
        <div class="w-full lg:w-80 shrink-0">
            <div class="bg-gray-50/50 dark:bg-gray-800/50 rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        History Panel
                    </h3>
                    <span class="text-xs text-gray-400">{{ $history->flatten()->count() }} items</span>
                </div>
                
                <div class="p-4 max-h-[calc(100vh-12rem)] overflow-y-auto">
                    @if($history->isEmpty())
                        <div class="text-center py-6">
                            <p class="text-xs text-gray-400 dark:text-gray-500">No archived schedules over 1 week old.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $dayName)
                                @if(isset($history[$dayName]))
                                <div class="mb-2">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">{{ $dayName }}</h4>
                                    <div class="space-y-2">
                                        @foreach($history[$dayName] as $item)
                                        <div class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 opacity-70 hover:opacity-100 transition-opacity">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $item->subject }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">Class {{ $item->class }} &bull; Period {{ $item->start_time }}-{{ $item->end_time }}</p>
                                            <div class="mt-3 flex items-center justify-between">
                                                <span class="text-[10px] text-gray-400">{{ $item->updated_at->diffForHumans() }}</span>
                                                <a href="{{ route('schedule.edit', $item->id) }}" class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">Restore / Edit</a>
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
    </div>

@endsection
