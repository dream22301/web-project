<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Teacher Dashboard') | SMKN 1 Lumajang</title>

    <!-- Anti-flicker: apply dark class BEFORE any CSS renders -->
    <script>
        (function () {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 transition-colors duration-200">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Logo Header for Guest Layout -->
        <div class="flex justify-center items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center text-white shadow-sm">
                <img src="{{ asset('images/smkn1.png') }}" alt="">
            </div>
            <span class="font-bold text-2xl text-gray-900 dark:text-gray-100">SMKN 1 Lumajang</span>
        </div>
        
        <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 dark:text-gray-100">
            @yield('header')
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-120">
        <div class="bg-white dark:bg-gray-800 px-6 py-10 sm:px-12 shadow-sm border border-gray-100 dark:border-gray-700 sm:rounded-xl transition-colors">
            @yield('content')
        </div>
        
        <!-- Footer / Back links -->
        <p class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
            @yield('footer')
        </p>
    </div>

</body>
</html>
