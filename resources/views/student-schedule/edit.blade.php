@extends('layouts.app')

@section('title', 'Edit Jadwal Siswa')

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
        <div class="flex items-center gap-4">
            <a href="{{ route('student-schedule.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Jadwal Siswa</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update jadwal pelajaran siswa.</p>
            </div>
        </div>
    </div>

    {{-- Edit Form --}}
    <div class="max-w-3xl bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors mb-8">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Detail Jadwal</h3>
        </div>

        <form action="{{ route('student-schedule.update', $schedule->id) }}" method="POST" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">

                {{-- Hari --}}
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Hari</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                        <div class="flex items-center">
                            <input id="day-{{ strtolower($day) }}" name="day" type="radio" value="{{ $day }}"
                                   class="h-4 w-4 border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-600 dark:bg-gray-700"
                                   {{ old('day', $schedule->day) == $day ? 'checked' : '' }}>
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
                        <option value="{{ $subj }}" {{ old('subject', $schedule->subject) == $subj ? 'selected' : '' }}>{{ $subj }}</option>
                        @endforeach
                    </select>
                    @error('subject') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- Ruang --}}
                <div>
                    <label for="room" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Di Ruang</label>
                    <input type="text" id="room" name="room" value="{{ old('room', $schedule->room) }}"
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
                        <option value="{{ $cls }}" {{ old('class_major', $schedule->class_major) == $cls ? 'selected' : '' }}>{{ $cls }}</option>
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
                        <input type="number" id="period_start" name="period_start" value="{{ old('period_start', $schedule->period_start) }}"
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
                        <input type="number" id="period_end" name="period_end" value="{{ old('period_end', $schedule->period_end) }}"
                        min="1" max="12" placeholder="4"
                        class="block w-full rounded-md border-0 pl-10 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                        {{ $errors->has('period_end') ? 'ring-red-400 dark:ring-red-500' : 'ring-gray-300 dark:ring-gray-600' }}">
                        @error('period_end') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>

            </div>

            <div class="mt-8 flex items-center justify-end gap-3">
                <a href="{{ url()->previous() }}" class="inline-flex justify-center items-center gap-2 rounded-md bg-white dark:bg-gray-800 px-5 py-2.5 text-sm font-semibold text-gray-900 dark:text-gray-300 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex justify-center items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
