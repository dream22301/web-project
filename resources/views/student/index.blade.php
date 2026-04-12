@extends('layouts.app')

@section('title', 'Daftar Siswa')

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
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Daftar Siswa</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola dan daftarkan siswa ke dalam sistem.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <!-- Left Column: Add Form -->
        <div class="flex-1 w-full lg:max-w-md">
            {{-- Form Tambah Siswa --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors mb-8 sticky top-6">
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Registrasi Siswa</h3>
                </div>

                <form action="{{ route('student.store') }}" method="POST" class="p-6 sm:p-8">
                    @csrf

                    <div class="space-y-6">

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   placeholder="Contoh: Budi Santoso"
                                   required
                                   class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                          {{ $errors->has('name') ? 'ring-red-400 dark:ring-red-500' : 'ring-gray-300 dark:ring-gray-600' }}">
                            @error('name') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIS --}}
                        <div>
                            <label for="nis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nomor Induk Siswa (NIS)</label>
                            <input type="text" id="nis" name="nis" value="{{ old('nis') }}"
                                   placeholder="Contoh: 12345"
                                   required
                                   class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                          {{ $errors->has('nis') ? 'ring-red-400 dark:ring-red-500' : 'ring-gray-300 dark:ring-gray-600' }}">
                            @error('nis') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- Class/Major --}}
                        <div>
                            <label for="class_major" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kelas / Jurusan</label>
                            <input type="text" id="class_major" name="class_major" value="{{ old('class_major') }}"
                                   placeholder="Contoh: XI RPL"
                                   required
                                   class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                          {{ $errors->has('class_major') ? 'ring-red-400 dark:ring-red-500' : 'ring-gray-300 dark:ring-gray-600' }}">
                            @error('class_major') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end">
                        <button type="submit"
                                class="w-full inline-flex justify-center items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Daftarkan Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column: List -->
        <div class="w-full flex-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Data Siswa Terdaftar</h3>
                        <span class="text-xs text-gray-400">{{ $students->total() }} orang</span>
                    </div>

                    <!-- Search Bar -->
                    <form action="{{ route('student.index') }}" method="GET" class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-200 dark:border-gray-700 rounded-md leading-5 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 sm:text-sm transition-colors"
                               placeholder="Cari siswa...">
                    </form>
                </div>
                
                <div class="overflow-x-auto">
                    @if($students->isEmpty())
                        <div class="text-center py-10">
                            <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada siswa.</p>
                        </div>
                    @else
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b border-gray-200 dark:border-gray-600">
                                <tr>
                                    <th scope="col" class="px-6 py-3">NIS</th>
                                    <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-3">Kelas/Jurusan</th>
                                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $student->nis }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                                            {{ $student->class_major }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                
                @if(!$students->isEmpty())
                <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $students->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
