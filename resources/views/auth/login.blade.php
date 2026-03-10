@extends('layouts.guest')

@section('title', 'Sign In')
@section('header', 'Sign in to your account')

@section('content')

    <form class="space-y-6" action="{{ route('log-in') }}" method="POST">
        @csrf

        {{-- Failed Login Banner --}}
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

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                Password
            </label>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password"
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset text-sm transition-colors
                              {{ $errors->has('password') ? 'ring-red-400 dark:ring-red-500 focus:ring-red-500' : 'ring-gray-300 dark:ring-gray-600 focus:ring-blue-600' }}">
            </div>
            @error('password') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>


        {{-- Submit --}}
        <div>
            <button type="submit"
                    class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                Sign in
            </button>
        </div>
    </form>

@endsection

@section('footer')
    Not a member? 
    <a href="{{ url('/register') }}" class="font-semibold leading-6 text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
        Register a new account
    </a>
@endsection
