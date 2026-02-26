@extends('layouts.guest')

@section('title', 'Sign In')
@section('header', 'Sign in to your account')

@section('content')

    <form class="space-y-6" action="#" method="POST">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                Email address
            </label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required 
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-blue-600 text-sm transition-colors">
            </div>
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">
                Password
            </label>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password" required 
                       class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-blue-600 text-sm transition-colors">
            </div>
        </div>

        {{-- Remember me & Forgot Password --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" 
                       class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-600 dark:bg-gray-700">
                <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-700 dark:text-gray-300">
                    Remember me
                </label>
            </div>

            <div class="text-sm leading-6">
                <a href="#" class="font-semibold text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                    Forgot password?
                </a>
            </div>
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
