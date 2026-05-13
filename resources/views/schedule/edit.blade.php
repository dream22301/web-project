@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ url('/schedule') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Jadwal</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Perbarui detail jadwal kelas.</p>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="max-w-3xl bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors">

        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Detail Jadwal</h3>
        </div>

        <form action="{{ route('schedule.update', $schedule->id) }}" method="POST" class="p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Mata Pelajaran</label>
                    <select id="subject" name="subject"
                            class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                        <option value="">Pilih mata pelajaran...</option>
                        @foreach([
                            'Konsen RPL', 'Bahasa Indonesia', 'Bahasa Inggris', 'Matematika',
                            'Kewirausahaan', 'Pendidikan Jasmani olahraga dan kesehatan',
                            'Desain Grafis', 'Bimbingan konseling', 'Sejarah',
                            'Pendidikan Pancasila', 'Bahasa Jawa', 'Pendidikan Agama dan Budi Pekerti'
                        ] as $subj)
                        <option value="{{ $subj }}" {{ old('subject', $schedule->subject) == $subj ? 'selected' : '' }}>{{ $subj }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Class -->
                <div>
                    <label for="class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kelas</label>
                    <select id="class" name="class"
                            class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                        <option value="">Pilih kelas...</option>
                        @foreach(['X Teknik Kimia Industri 1', 'X Teknik Kimia Industri 2', 'X Geomatika', 'X Rekayasa Perangkat Lunak', 'X Teknik Komputer dan Jaringan 1', 'X Teknik Komputer dan Jaringan 2', 'X Bisnis Digital 1', 'X Bisnis Digital 2', 'X Bisnis Retail', 'X Manajemen Perkantoran 1', 'X Manajemen Perkantoran 2', 'X Akuntansi 1', 'X Akuntansi 2', 'X Akuntansi 3', 'X Teknik Grafika 1', 'X Teknik Grafika 2', 'X Produksi & Siaran Program Televisi 1', 'X Produksi & Siaran Program Televisi 2', 'XI Teknik Kimia Industri 1', 'XI Teknik Kimia Industri 2', 'XI Geomatika', 'XI Rekayasa Perangkat Lunak', 'XI Teknik Komputer dan Jaringan 1', 'XI Teknik Komputer dan Jaringan 2', 'XI Bisnis Digital 1', 'XI Bisnis Digital 2', 'XI Bisnis Retail', 'XI Manajemen Perkantoran 1', 'XI Manajemen Perkantoran 2', 'XI Akuntansi 1', 'XI Akuntansi 2', 'XI Akuntansi 3', 'XI Teknik Grafika 1', 'XI Teknik Grafika 2', 'XI Produksi & Siaran Program Televisi 1', 'XI Produksi & Siaran Program Televisi 2'] as $cls)
                        <option value="{{ $cls }}" {{ old('class', $schedule->class) == $cls ? 'selected' : '' }}>{{ $cls }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Day Selection -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Hari</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                        <div class="flex items-center">
                            <input id="day-{{ strtolower($day) }}" name="day" type="radio" value="{{ $day }}"
                                   class="h-4 w-4 border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-600 dark:bg-gray-700"
                                   {{ old('day', $schedule->day) == $day ? 'checked' : '' }}>
                            <label for="day-{{ strtolower($day) }}" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $day }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Start Time -->
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jam Pelajaran Mulai</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input type="number" id="start_time" name="start_time" placeholder="1" min="1" max="12" value="{{ old('start_time', $schedule->start_time) }}"
                               class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                    </div>
                </div>

                <!-- End Time -->
                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jam Pelajaran Selesai</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input type="number" id="end_time" name="end_time" placeholder="4" min="1" max="12" value="{{ old('end_time', $schedule->end_time) }}"
                               class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                    </div>
                </div>

            </div>

            <!-- Actions -->
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
