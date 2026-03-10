@extends('layouts.guest')

@section('title', 'Register')
@section('header', 'Register a new account')

@section('content')

    <form class="space-y-6" action="{{ route('regist') }}" method="POST">
        @csrf

        {{-- Failed Banner --}}
        @if(session('failed'))
        <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-300 text-sm">
            <svg class="w-5 h-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('failed') }}
        </div>
        @endif

        {{-- Validation Errors Banner --}}
        @if($errors->any())
        <div class="flex items-start gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-300 text-sm">
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

        {{-- Full Name --}}
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                Full name
            </label>
            <div class="mt-2">
                <input id="name" name="name" type="text" autocomplete="name" value="{{ old('name') }}"
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset text-sm transition-colors
                              {{ $errors->has('name') ? 'ring-red-400 dark:ring-red-500 focus:ring-red-500' : 'ring-gray-300 dark:ring-gray-600 focus:ring-blue-600' }}">
            </div>
            @error('name') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                Email address
            </label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}"
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset text-sm transition-colors
                              {{ $errors->has('email') ? 'ring-red-400 dark:ring-red-500 focus:ring-red-500' : 'ring-gray-300 dark:ring-gray-600 focus:ring-blue-600' }}">
            </div>
            @error('email') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Subject Type --}}
        <div>
            <label for="subject_type" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                Teacher Subject
            </label>
            <div class="mt-2">
                <select id="subject_type" name="subject_type"
                        class="block w-full rounded-md border-0 py-2.5 px-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset focus:ring-2 focus:ring-inset text-sm transition-colors
                               {{ $errors->has('subject_type') ? 'ring-red-400 dark:ring-red-500 focus:ring-red-500' : 'ring-gray-300 dark:ring-gray-600 focus:ring-blue-600' }}">
                    <option value="">Select your subject...</option>
                    <option value="RPL" {{ old('subject_type') == 'RPL' ? 'selected' : '' }}>RPL</option>
                    <option value="Bahasa Indonesia" {{ old('subject_type') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                    <option value="Bahasa Inggris" {{ old('subject_type') == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
                    <option value="Matematika" {{ old('subject_type') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                    <option value="Kewirausahaan" {{ old('subject_type') == 'Kewirausahaan' ? 'selected' : '' }}>Kewirausahaan</option>
                    <option value="PJOK" {{ old('subject_type') == 'PJOK' ? 'selected' : '' }}>Pendidikan Jasmani Olahraga dan Kesehatan</option>
                    <option value="Desain Grafis" {{ old('subject_type') == 'Desain Grafis' ? 'selected' : '' }}>Desain Grafis</option>
                    <option value="Bimbingan Konseling" {{ old('subject_type') == 'Bimbingan Konseling' ? 'selected' : '' }}>Bimbingan Konseling</option>
                    <option value="Sejarah" {{ old('subject_type') == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                    <option value="Pendidikan Pancasila" {{ old('subject_type') == 'Pendidikan Pancasila' ? 'selected' : '' }}>Pendidikan Pancasila</option>
                    <option value="Bahasa Jawa" {{ old('subject_type') == 'Bahasa Jawa' ? 'selected' : '' }}>Bahasa Jawa</option>
                    <option value="Pendidikan Agama" {{ old('subject_type') == 'Pendidikan Agama' ? 'selected' : '' }}>Pendidikan Agama dan Budi Pekerti</option>
                    <option value="Other" {{ old('subject_type') == 'Other' ? 'selected' : '' }}>Other Subject</option>
                </select>
            </div>
            @error('subject_type') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                Password
            </label>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="new-password"
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset text-sm transition-colors
                              {{ $errors->has('password') ? 'ring-red-400 dark:ring-red-500 focus:ring-red-500' : 'ring-gray-300 dark:ring-gray-600 focus:ring-blue-600' }}">
            </div>
            @error('password') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                Confirm password
            </label>
            <div class="mt-2">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-blue-600 text-sm transition-colors">
            </div>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit"
                    class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                Register
            </button>
        </div>
    </form>

@endsection

@section('footer')
    Already have an account? 
    <a href="{{ url('/') }}" class="font-semibold leading-6 text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
        Sign in instead
    </a>
@endsection
