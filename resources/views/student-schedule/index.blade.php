@extends('layouts.app')

@section('title', 'Jadwal Siswa')

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

    @if($errors->any())
    <div class="mb-6 flex items-start gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-300 text-sm">
        <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Jadwal Siswa</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola jadwal pelajaran siswa per hari dan jam pelajaran.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <!-- Left Column: Active Content & Form -->
        <div class="flex-1 w-full lg:max-w-3xl">
            {{-- Form Tambah Jadwal --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors mb-8">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Tambah Jadwal Baru</h3>
                </div>

                <form action="{{ route('student-schedule.store') }}" method="POST" class="p-6 sm:p-8">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">

                        {{-- Hari --}}
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Hari</label>
                            <div class="flex flex-wrap gap-4">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat',] as $day)
                                <div class="flex items-center">
                                    <input id="day-{{ strtolower($day) }}" name="day" type="radio" value="{{ $day }}"
                                           class="h-4 w-4 border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-600 dark:bg-gray-700"
                                           {{ old('day') == $day ? 'checked' : '' }}>
                                    <label for="day-{{ strtolower($day) }}" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $day }}</label>
                                </div>
                                @endforeach
                            </div>
                            @error('day') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- Pelajaran --}}
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pelajaran</label>
                            <select id="subject" name="subject"
                                    class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                           {{ $errors->has('subject') ? 'ring-red-400 dark:ring-red-500' : '' }}">
                                <option value="">Pilih pelajaran...</option>
                                @foreach([
                                    'Konsen RPL', 'Bahasa Indonesia', 'Bahasa Inggris', 'Matematika',
                                    'Kewirausahaan', 'Pendidikan Jasmani Olahraga dan Kesehatan',
                                    'Desain Grafis', 'Bimbingan Konseling', 'Sejarah',
                                    'Pendidikan Pancasila', 'Bahasa Jawa', 'Pendidikan Agama dan Budi Pekerti'
                                ] as $subj)
                                <option value="{{ $subj }}" {{ old('subject') == $subj ? 'selected' : '' }}>{{ $subj }}</option>
                                @endforeach
                            </select>
                            @error('subject') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- Ruang --}}
                        <div>
                            <label for="room" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Di Ruang</label>
                            <input type="text" id="room" name="room" value="{{ old('room') }}"
                                   placeholder="Contoh: Ruang 8, Lab RPL, Aula..."
                                   class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                          {{ $errors->has('room') ? 'ring-red-400 dark:ring-red-500' : 'ring-gray-300 dark:ring-gray-600' }}">
                            @error('room') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kelas / Jurusan --}}
                        <div>
                            <label for="class_major" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kelas / Jurusan</label>
                            <select id="class_major" name="class_major"
                                    class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                           {{ $errors->has('class_major') ? 'ring-red-400 dark:ring-red-500' : '' }}">
                                <option value="">Pilih kelas...</option>
                                @foreach(['X RPL', 'XI RPL', 'XII RPL'] as $cls)
                                <option value="{{ $cls }}" {{ old('class_major') == $cls ? 'selected' : '' }}>{{ $cls }}</option>
                                @endforeach
                            </select>
                            @error('class_major') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- Jam Pelajaran --}}
                        <div>
                            <label for="period_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dari Jam Pelajaran Ke</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>

                                <input type="number" id="period_start" name="period_start" value="{{ old('period_start') }}"
                                min="1" max="12" placeholder="1"
                                class="block w-full rounded-md pl-10 border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                {{ $errors->has('period_start') ? 'ring-red-400 dark:ring-red-500' : 'ring-gray-300 dark:ring-gray-600' }}">
                                @error('period_start') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="period_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sampai Jam Pelajaran Ke</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>

                                <input type="number" id="period_end" name="period_end" value="{{ old('period_end') }}"
                                min="1" max="12" placeholder="4"
                                class="block w-full rounded-md border-0 pl-10 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                {{ $errors->has('period_end') ? 'ring-red-400 dark:ring-red-500' : 'ring-gray-300 dark:ring-gray-600' }}">
                                @error('period_end') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end">
                        <button type="submit"
                                class="inline-flex justify-center items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>

            {{-- Published Schedules grouped by day --}}
            <div class="space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jadwal Terpublish</h2>
                        <span class="text-sm text-gray-400 dark:text-gray-500">{{ $schedules->total() }} total</span>
                    </div>

                    <!-- Search Bar -->
                    <form action="{{ route('student-schedule.index') }}" method="GET" class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-200 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 sm:text-sm transition-colors"
                               placeholder="Cari jadwal...">
                    </form>
                </div>

                @if($schedules->isEmpty())
                    <div class="text-center py-10 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                        <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada jadwal siswa. Tambahkan jadwal di atas.</p>
                    </div>
                @else
                    @php
                        $groupedSchedules = collect($schedules->items())->groupBy('day');
                    @endphp
                    <div class="space-y-6">
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $dayName)
                            @if(isset($groupedSchedules[$dayName]))
                            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                                {{-- Day Header --}}
                                <div class="flex items-center gap-3 px-5 py-3 bg-blue-50 dark:bg-blue-900/30 border-b border-blue-100 dark:border-blue-800">
                                    <svg class="w-4 h-4 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <h3 class="text-sm font-bold text-blue-700 dark:text-blue-300 uppercase tracking-wide">{{ $dayName }}</h3>
                                    <span class="ml-auto text-xs text-blue-500 dark:text-blue-400">{{ $groupedSchedules[$dayName]->count() }} pelajaran</span>
                                </div>

                                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @foreach($groupedSchedules[$dayName]->sortBy('period_start') as $schedule)
                                    <div class="flex items-center justify-between gap-4 px-5 py-4">
                                        {{-- Period Badge --}}
                                        <div class="shrink-0 flex items-center justify-center w-12 h-12 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-bold text-sm leading-tight text-center">
                                            {{ $schedule->period_start }}<br><span class="text-xs font-normal opacity-70">— {{ $schedule->period_end }}</span>
                                        </div>

                                        {{-- Info --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-wrap items-center gap-2 mb-0.5">
                                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $schedule->subject }}</p>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400">
                                                    {{ $schedule->class_major }}
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-1 mt-0.5">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Di Ruang {{ $schedule->room }}</p>
                                            </div>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                                                Jam pelajaran ke-{{ $schedule->period_start }} sampai ke-{{ $schedule->period_end }}
                                            </p>
                                        </div>

                                        {{-- Actions --}}
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('student-schedule.edit', $schedule->id) }}"
                                               class="shrink-0 p-2 rounded-md text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:text-blue-400 dark:hover:bg-blue-900/30 transition-colors"
                                               title="Edit jadwal">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('student-schedule.destroy', $schedule->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="shrink-0 p-2 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:text-red-400 dark:hover:bg-red-900/30 transition-colors"
                                                        title="Hapus jadwal">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
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
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $dayName)
                                @if(isset($history[$dayName]))
                                <div class="mb-2">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase mb-2">{{ $dayName }}</h4>
                                    <div class="space-y-2">
                                        @foreach($history[$dayName] as $item)
                                        <div class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 opacity-70 hover:opacity-100 transition-opacity">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $item->subject }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">Ruang: {{ $item->room }} &bull; Jam: {{ $item->period_start }}-{{ $item->period_end }}</p>
                                            <div class="mt-3 flex items-center justify-between">
                                                <span class="text-[10px] text-gray-400">{{ $item->updated_at->diffForHumans() }}</span>
                                                <a href="{{ route('student-schedule.edit', $item->id) }}" class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">Restore / Edit</a>
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
