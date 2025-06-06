<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navigation -->
        <nav class="fixed z-50 w-full bg-white/80 dark:bg-gray-800/80 backdrop-blur-md">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="flex items-center">
                            <x-application-logo class="w-auto h-8 text-gray-800 dark:text-gray-200" />
                            <span class="ml-3 text-lg font-semibold text-gray-800 dark:text-gray-200">Masjid Ar-Ridho</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/about" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">About</a>
                        <a href="/terms" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Terms</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md dark:border-gray-600 dark:text-gray-300 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">Login Panitia</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="pt-32 pb-16">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="text-center fade-in">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white sm:text-5xl lg:text-6xl">
                        About <span class="text-blue-600">Corex</span>
                    </h1>
                    <p class="max-w-3xl mx-auto mt-6 text-lg text-gray-600 dark:text-gray-400 sm:text-xl">
                        Developing innovative solutions for web and mobile applications with a focus on quality and user experience
                    </p>
                </div>
            </div>
        </div>

        <!-- About Content -->
        <div class="py-20 bg-white dark:bg-gray-800">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid gap-12 md:grid-cols-2">
                    <!-- Company Info -->
                    <div class="p-8 fade-in bg-gray-50 dark:bg-gray-700/50 rounded-xl" style="animation-delay: 0.2s">
                        <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Our Story</h2>
                        <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                            Corex is a leading software development company specializing in creating modern web applications
                            and mobile solutions. Founded by Nur Dwi Priyambodo, we are committed to delivering high-quality,
                            user-centric applications that meet our clients' needs.
                        </p>
                    </div>

                    <!-- Services -->
                    <div class="p-8 fade-in bg-gray-50 dark:bg-gray-700/50 rounded-xl" style="animation-delay: 0.4s">
                        <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Our Services</h2>
                        <ul class="space-y-6">
                            <li class="flex items-center space-x-4">
                                <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg dark:bg-blue-900/50">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Web Development</h3>
                                    <p class="text-gray-600 dark:text-gray-300">Custom web applications and solutions</p>
                                </div>
                            </li>
                            <li class="flex items-center space-x-4">
                                <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg dark:bg-blue-900/50">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Mobile Development</h3>
                                    <p class="text-gray-600 dark:text-gray-300">Android app development and solutions</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="mt-20 fade-in" style="animation-delay: 0.6s">
                    <div class="p-12 text-center bg-blue-50 dark:bg-blue-900/20 rounded-2xl">
                        <h2 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">Let's Work Together</h2>
                        <p class="max-w-2xl mx-auto mb-8 text-lg text-gray-600 dark:text-gray-300">
                            Ready to start your next project? Get in touch with us to discuss how we can help bring your ideas to life.
                        </p>
                        <a href="mailto:nurdwipriyambodo@ndp.my.id"
                           class="inline-flex items-center px-8 py-4 text-lg font-medium text-white transition-colors duration-200 bg-blue-600 rounded-xl hover:bg-blue-700">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-50 dark:bg-gray-800">
            <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <x-application-logo class="w-auto h-8 text-gray-800 dark:text-gray-200" />
                        <span class="text-sm text-gray-500 dark:text-gray-400">© {{ date('Y') }} Masjid Ar-Ridho</span>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Developed by corex
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
