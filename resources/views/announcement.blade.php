@extends('layouts.app')

@section('title', 'Announcement')

@section('content')

    {{-- Success Flash Message --}}
    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 text-sm font-medium">
        <svg class="w-5 h-5 shrink-0 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Validation Error Banner --}}
    @if($errors->any())
    <div class="mb-6 flex items-start gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-300 text-sm">
        <svg class="w-5 h-5 shrink-0 mt-0.5 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="font-medium mb-1">Please fix the following errors:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif


    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Announcements</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Create and publish announcements for your students.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <!-- Left Column: Active Content & Form -->
        <div class="flex-1 w-full lg:max-w-3xl">
            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors">

                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">New Announcement</h3>
                </div>

                <form action="{{ route('announcement.database1') }}" method="POST" class="p-6 sm:p-8 space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Title
                        </label>
                        <input type="text" id="title" name="title" placeholder="e.g. School Holiday Notice" value="{{ old('title') }}"
                               class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 text-sm transition-colors
                                      {{ $errors->has('title') ? 'ring-red-400 dark:ring-red-500 focus:ring-red-500' : 'ring-gray-300 dark:ring-gray-600 focus:ring-blue-600' }}">
                        @error('title')
                            <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Target Audience -->
                    <div>
                        <label for="audience" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Target Audience
                        </label>
                        <select id="audience" name="audience"
                                class="block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset focus:ring-2 text-sm transition-colors
                                       {{ $errors->has('audience') ? 'ring-red-400 dark:ring-red-500 focus:ring-red-500' : 'ring-gray-300 dark:ring-gray-600 focus:ring-blue-600' }}">
                            <option value="">Select audience...</option>
                            <option value="all" {{ old('audience') == 'all' ? 'selected' : '' }}>All Students</option>
                            <option value="x"   {{ old('audience') == 'x'   ? 'selected' : '' }}>Grade X</option>
                            <option value="xi"  {{ old('audience') == 'xi'  ? 'selected' : '' }}>Grade XI</option>
                            <option value="xii" {{ old('audience') == 'xii' ? 'selected' : '' }}>Grade XII</option>
                        </select>
                        @error('audience')
                            <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Priority</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach([
                                ['value' => 0,  'label' => 'Normal',  'color' => 'text-gray-600 dark:text-gray-300'],
                                ['value' => 1,    'label' => 'Info',    'color' => 'text-blue-600 dark:text-blue-400'],
                                ['value' => 2, 'label' => 'Warning', 'color' => 'text-amber-600 dark:text-amber-400'],
                                ['value' => 3,  'label' => 'Urgent',  'color' => 'text-red-600 dark:text-red-400'],
                            ] as $p)
                            <div class="flex items-center">
                                <input id="priority-{{ $p['value'] }}" name="prioritas" type="radio" value="{{ $p['value'] }}"
                                       class="h-4 w-4 border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-600 dark:bg-gray-700"
                                       {{ $p['value'] === 0 ? 'checked' : '' }}>
                                <label for="priority-{{ $p['value'] }}" class="ml-2 text-sm font-medium {{ $p['color'] }}">
                                    {{ $p['label'] }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('prioritas')
                            <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Content
                        </label>
                        <textarea id="content" name="content" rows="6"
                                  placeholder="Write your announcement here..."
                                  class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 text-sm transition-colors resize-none
                                         {{ $errors->has('content') ? 'ring-red-400 dark:ring-red-500 focus:ring-red-500' : 'ring-gray-300 dark:ring-gray-600 focus:ring-blue-600' }}">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publish Date -->
                    <div>
                        <label for="publish_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Publish Date
                        </label>
                        <div class="relative max-w-xs">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="date" id="publish_date" name="publish_date"
                                   class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="submit"
                                class="inline-flex justify-center items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Publish Announcement
                        </button>
                    </div>

                </form>
            </div>

            {{-- Announcements List --}}
            <div class="mt-8 mb-8" id="announcement-list">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Published Announcements</h2>
                        <span class="text-sm text-gray-400 dark:text-gray-500">{{ $announcements->total() }} total</span>
                    </div>

                    <!-- Search Bar -->
                    <form action="{{ route('announcement.index') }}" method="GET" class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-200 dark:border-gray-700 rounded-md leading-5 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 sm:text-sm transition-colors"
                               placeholder="Search announcements...">
                    </form>
                </div>

                @if($announcements->isEmpty())
                    <div class="text-center py-10 bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                        <svg class="mx-auto w-10 h-10 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-sm text-gray-400 dark:text-gray-500">No announcements yet. Create your first one above.</p>
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($announcements as $announcement)
                        @php
                            $priorityConfig = [
                                0 => ['label' => 'Normal',  'class' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300'],
                                1 => ['label' => 'Info',    'class' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400'],
                                2 => ['label' => 'Warning', 'class' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-400'],
                                3 => ['label' => 'Urgent',  'class' => 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400'],
                            ][$announcement->prioritas] ?? ['label' => 'Normal', 'class' => 'bg-gray-100 text-gray-600'];
                        @endphp
                        <div class="flex items-start justify-between gap-4 px-5 py-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                        {{ $announcement->title }}
                                    </span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $priorityConfig['class'] }}">
                                        {{ $priorityConfig['label'] }}
                                    </span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">{{ ucfirst($announcement->audience) }}</span>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $announcement->content }}</p>
                                @if($announcement->publish_date)
                                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                    Publish: {{ \Carbon\Carbon::parse($announcement->publish_date)->format('d M Y') }}
                                </p>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-2">
                                <a href="{{ route('announcement.edit', $announcement->id) }}" 
                                   class="shrink-0 p-2 rounded-md text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:text-blue-400 dark:hover:bg-blue-900/30 transition-colors"
                                   title="Edit announcement">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('announcement.destroy', $announcement->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this announcement?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="shrink-0 p-2 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:text-red-400 dark:hover:bg-red-900/30 transition-colors"
                                            title="Delete announcement">
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
                        {{ $announcements->links() }}
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
                    <span class="text-xs text-gray-400">{{ $history->count() }} items</span>
                </div>
                
                <div class="p-4 max-h-[calc(100vh-12rem)] overflow-y-auto">
                    @if($history->isEmpty())
                        <div class="text-center py-6">
                            <p class="text-xs text-gray-400 dark:text-gray-500">No archived items over 1 week old.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($history as $item)
                            <div class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 opacity-70 hover:opacity-100 transition-opacity">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">{{ $item->title }}</h4>
                                <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $item->content }}</p>
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="text-[10px] text-gray-400">Updated: {{ $item->updated_at->diffForHumans() }}</span>
                                    <a href="{{ route('announcement.edit', $item->id) }}" class="text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">Restore / Edit</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection