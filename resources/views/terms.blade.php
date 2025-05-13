<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Terms & Conditions - {{ config('app.name') }}</title>
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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

            <!-- Content -->
            <div class="px-4 pt-32 pb-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-8">
                        <div class="animate-fade-in">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                Terms and Conditions
                            </h1>

                            <div class="mt-8 space-y-6 text-gray-600 dark:text-gray-300">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Software Development and Ownership</h2>
                                    <p class="mt-3">
                                        This website is developed and maintained by Corex, owned by Nur Dwi Priyambodo. All rights
                                        reserved. The software and its contents are protected by intellectual property laws.
                                    </p>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Contact Information</h2>
                                    <div class="mt-3">
                                        <p>For business inquiries and collaboration opportunities, please contact:</p>
                                        <ul class="mt-2 ml-6 list-disc">
                                            <li>Company: Corex</li>
                                            <li>Owner: Nur Dwi Priyambodo</li>
                                            <li>Email: <a href="mailto:nurdwipriyambodo@ndp.my.id" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">nurdwipriyambodo@ndp.my.id</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Services</h2>
                                    <div class="mt-3">
                                        <p>Corex specializes in:</p>
                                        <ul class="mt-2 ml-6 list-disc">
                                            <li>Custom Web Application Development</li>
                                            <li>Mobile Android Application Development</li>
                                            <li>Software Consulting Services</li>
                                        </ul>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Privacy and Data Protection</h2>
                                    <p class="mt-3">
                                        We are committed to protecting your privacy and handling your data with care. All information
                                        collected through this website is processed in accordance with applicable data protection laws.
                                    </p>
                                </div>

                                <div class="p-6 mt-8 bg-blue-50 rounded-xl dark:bg-blue-900/20">
                                    <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-300">Contact Us</h3>
                                    <p class="mt-2 text-blue-700 dark:text-blue-400">
                                        For any questions regarding these terms or to discuss potential collaboration, please
                                        email us at <a href="mailto:nurdwipriyambodo@ndp.my.id" class="underline">nurdwipriyambodo@ndp.my.id</a>
                                    </p>
                                </div>
                            </div>
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
