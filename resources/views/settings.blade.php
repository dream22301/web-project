@extends('layouts.app')

@section('title', 'Settings')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Settings</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your profile and account security.</p>
    </div>

    <div class="max-w-2xl space-y-8">

        {{-- ── Profile Card ─────────────────────────────────────── --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Edit Profile</h3>
            </div>

            @if(session('success_profile'))
            <div class="mx-6 mt-5 flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 text-sm font-medium">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success_profile') }}
            </div>
            @endif

            <form action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                @csrf

                {{-- Avatar --}}
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <img id="photo-preview"
                             src="{{ $user->profilePhotoUrl() }}"
                             alt="Profile photo"
                             class="w-20 h-20 rounded-full object-cover ring-4 ring-gray-100 dark:ring-gray-700">
                        <label for="profile_photo"
                               class="absolute -bottom-1 -right-1 w-7 h-7 rounded-full bg-blue-600 hover:bg-blue-500 text-white flex items-center justify-center cursor-pointer shadow-md transition-colors"
                               title="Upload photo">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </label>
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden"
                               onchange="previewPhoto(this)">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $user->email }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">JPG, PNG, WebP · max 2 MB</p>
                    </div>
                </div>
                @error('profile_photo') <p class="text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Display Name
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                           class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                  {{ $errors->has('name') ? 'ring-red-400 dark:ring-red-500' : '' }}">
                    @error('name') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 transition-colors">
                        Save Profile
                    </button>
                </div>
            </form>
        </div>

        {{-- ── Change Password Card ──────────────────────────────── --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 transition-colors">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">Change Password</h3>
            </div>

            @if(session('success_password'))
            <div class="mx-6 mt-5 flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 text-sm font-medium">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success_password') }}
            </div>
            @endif

            @if($errors->has('current_password'))
            <div class="mx-6 mt-5 flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 text-red-800 dark:text-red-300 text-sm">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $errors->first('current_password') }}
            </div>
            @endif

            <form action="{{ route('settings.password') }}" method="POST" class="p-6 sm:p-8 space-y-5">
                @csrf

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                    <input type="password" id="current_password" name="current_password"
                           class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                  {{ $errors->has('current_password') ? 'ring-red-400 dark:ring-red-500' : '' }}">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                    <input type="password" id="password" name="password"
                           class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors
                                  {{ $errors->has('password') ? 'ring-red-400 dark:ring-red-500' : '' }}">
                    @error('password') <p class="mt-1.5 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 focus:ring-2 focus:ring-blue-600 text-sm transition-colors">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 transition-colors">
                        Change Password
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('photo-preview').src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
