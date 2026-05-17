@extends('layouts.app')

@section('title', 'Skor Murid')

@section('content')

    {{-- Page Header --}}
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('questions.index') }}" class="p-2 -ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Skor Murid</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Paket Soal: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $set->title }}</span> 
                <span class="mx-2 text-gray-300 dark:text-gray-600">|</span> 
                Kode: <span class="font-mono text-purple-600 dark:text-purple-400">{{ $set->key_code }}</span>
            </p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden transition-colors">
        <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Daftar Nilai</h3>
            <span class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $set->scores->count() }} Murid</span>
        </div>

        @if($set->scores->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <p class="text-sm text-gray-400 dark:text-gray-500">Belum ada murid yang mengerjakan paket soal ini.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 dark:text-gray-400 uppercase bg-gray-50 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-semibold">NIS</th>
                        <th scope="col" class="px-6 py-3 font-semibold">Nama Murid</th>
                        <th scope="col" class="px-6 py-3 font-semibold">Kelas / Jurusan</th>
                        <th scope="col" class="px-6 py-3 font-semibold">Skor</th>
                        <th scope="col" class="px-6 py-3 font-semibold">Waktu Pengerjaan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($set->scores as $score)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300 font-mono">{{ $score->student->nis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 font-medium">{{ $score->student->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $score->student->class_major }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                                {{ $score->score >= 75 ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                                {{ rtrim(rtrim($score->score, '0'), '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400 text-xs">
                            {{ $score->updated_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

@endsection
