<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms & Conditions - {{ config('app.name') }}</title>
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
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
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
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="pt-32 pb-16">
            <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
                <div class="p-8 bg-white shadow-xl rounded-2xl dark:bg-gray-800">
                    <div class="fade-in">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            Terms and Conditions
                        </h1>

                        <div class="mt-8 prose prose-blue dark:prose-invert max-w-none">
                            <h2>Software Development and Ownership</h2>
                            <p>
                                This website is developed and maintained by Corex, owned by Nur Dwi Priyambodo. All rights
                                reserved. The software and its contents are protected by intellectual property laws.
                            </p>

                            <h2 class="mt-8">Contact Information</h2>
                            <p>
                                For business inquiries and collaboration opportunities, please contact:
                            </p>
                            <ul>
                                <li>Company: Corex</li>
                                <li>Owner: Nur Dwi Priyambodo</li>
                                <li>Email: <a href="mailto:nurdwipriyambodo@ndp.my.id" class="text-blue-600 hover:text-blue-500">nurdwipriyambodo@ndp.my.id</a></li>
                            </ul>

                            <h2 class="mt-8">Services</h2>
                            <p>
                                Corex specializes in:
                            </p>
                            <ul>
                                <li>Custom Web Application Development</li>
                                <li>Mobile Android Application Development</li>
                                <li>Software Consulting Services</li>
                            </ul>

                            <h2 class="mt-8">Privacy and Data Protection</h2>
                            <p>
                                We are committed to protecting your privacy and handling your data with care. All information
                                collected through this website is processed in accordance with applicable data protection laws.
                            </p>

                            <div class="p-4 mt-8 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                <h3 class="text-blue-800 dark:text-blue-300">Contact Us</h3>
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
    </div>
</body>
</html>
