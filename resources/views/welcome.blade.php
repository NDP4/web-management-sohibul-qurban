<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Pengelolaan Data Sohibul Qurban') }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <!-- Navigation -->
            <nav class="fixed z-50 w-full bg-white/80 dark:bg-gray-800/80 backdrop-blur-md">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <x-application-logo class="w-auto h-8 text-gray-800 dark:text-gray-200" />
                            <span class="ml-3 text-lg font-semibold text-gray-800 dark:text-gray-200">Masjid Ar-Ridho</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ url('/about') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">About</a>
                            <a href="{{ url('/terms') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">Terms</a>
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md dark:border-gray-600 dark:text-gray-300 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        Login Panitia
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="relative overflow-hidden">
                <div class="px-4 pt-32 pb-16 mx-auto max-w-7xl sm:pt-40 sm:pb-20 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                            <span class="block">Sistem Pengelolaan</span>
                            <span class="block text-blue-600">Data Sohibul Qurban</span>
                        </h1>
                        <p class="max-w-md mx-auto mt-3 text-base text-gray-500 dark:text-gray-400 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                            Memudahkan pengelolaan data qurban dengan sistem yang terintegrasi untuk pencatatan, pembayaran, dan pelaporan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="py-12 bg-white dark:bg-gray-800">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                            Fitur Utama
                        </h2>
                        <p class="mt-4 text-xl text-gray-500 dark:text-gray-400">
                            Kelola data qurban dengan mudah dan efisien
                        </p>
                    </div>

                    <div class="mt-12">
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            <!-- Feature 1 -->
                            <div class="relative group">
                                <div class="relative h-full p-6 transition-shadow duration-300 bg-white border border-gray-200 rounded-2xl dark:border-gray-700 dark:bg-gray-800 hover:shadow-lg">
                                    <div class="inline-flex items-center justify-center w-12 h-12 mb-4 text-blue-600 bg-blue-100 rounded-xl dark:bg-blue-900 dark:text-blue-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Pencatatan Data</h3>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400">Catat data sohibul qurban dengan detail lengkap termasuk jenis hewan dan tipe qurban.</p>
                                </div>
                            </div>

                            <!-- Feature 2 -->
                            <div class="relative group">
                                <div class="relative h-full p-6 transition-shadow duration-300 bg-white border border-gray-200 rounded-2xl dark:border-gray-700 dark:bg-gray-800 hover:shadow-lg">
                                    <div class="inline-flex items-center justify-center w-12 h-12 mb-4 text-green-600 bg-green-100 rounded-xl dark:bg-green-900 dark:text-green-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Pembayaran</h3>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400">Kelola pembayaran dan generate kwitansi otomatis untuk setiap transaksi.</p>
                                </div>
                            </div>

                            <!-- Feature 3 -->
                            <div class="relative group">
                                <div class="relative h-full p-6 transition-shadow duration-300 bg-white border border-gray-200 rounded-2xl dark:border-gray-700 dark:bg-gray-800 hover:shadow-lg">
                                    <div class="inline-flex items-center justify-center w-12 h-12 mb-4 text-red-600 bg-red-100 rounded-xl dark:bg-red-900 dark:text-red-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Laporan</h3>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400">Export data ke PDF dan Excel untuk keperluan pelaporan dan dokumentasi.</p>
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
            // Check if dark mode is enabled
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </body>
</html>
