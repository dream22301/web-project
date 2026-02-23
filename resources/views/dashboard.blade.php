@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Welcome back! Here's a quick overview of today.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">

        <!-- Stat Card 1 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-50 dark:bg-blue-900/40 p-3 rounded-md">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Students</dt>
                        <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">1,240</dd>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-50 dark:bg-green-900/40 p-3 rounded-md">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Classes Today</dt>
                        <dd class="text-lg font-semibold text-gray-900 dark:text-gray-100">4</dd>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Placeholder content -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-100 dark:border-gray-700 min-h-[400px] flex items-center justify-center transition-colors">
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No recent activity</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Welcome to your clean new dashboard.</p>
        </div>
    </div>

@endsection
