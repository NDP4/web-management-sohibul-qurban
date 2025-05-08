@section('title', 'Dashboard')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Menu Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('sohibul-qurban.create') }}"
                           class="flex items-center justify-center p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            <span>Tambah Data Sohibul Qurban</span>
                        </a>
                        <a href="{{ route('sohibul-qurban.index') }}"
                           class="flex items-center justify-center p-4 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            <span>Lihat Data Sohibul Qurban</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Total Sohibul -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold">Total Sohibul Qurban</h3>
                            <p class="text-3xl font-bold mt-2">{{ App\Models\SohibulQurban::count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Sapi -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold">Total Sapi</h3>
                            @php
                                $collectiveCow = ceil(App\Models\SohibulQurban::where('jenis_hewan', 'sapi')
                                    ->where('is_collective', true)
                                    ->count() / 7);
                                $individualCow = App\Models\SohibulQurban::where('jenis_hewan', 'sapi')
                                    ->where('is_collective', false)
                                    ->count();
                                $totalCow = $collectiveCow + $individualCow;
                            @endphp
                            <p class="text-3xl font-bold mt-2">{{ $totalCow }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                ({{ $collectiveCow }} Kolektif + {{ $individualCow }} Individual)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Kambing -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold">Total Kambing</h3>
                            <p class="text-3xl font-bold mt-2">{{ App\Models\SohibulQurban::where('jenis_hewan', 'kambing')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sudah Bayar -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-semibold">Sudah Bayar</h3>
                            <p class="text-3xl font-bold mt-2">{{ App\Models\SohibulQurban::where('status_pembayaran', 'sudah_bayar')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Entries -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Data Terbaru</h3>
                        <a href="{{ route('sohibul-qurban.index') }}" class="text-blue-500 hover:text-blue-700">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-100">Nama</th>
                                    <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-100">Jenis Hewan</th>
                                    <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-100">Status</th>
                                    <th class="px-4 py-2 text-left text-gray-900 dark:text-gray-100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\SohibulQurban::latest()->take(5)->get() as $qurban)
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ $qurban->nama_sohibul }}</td>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">{{ ucfirst($qurban->jenis_hewan) }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-sm
                                            {{ $qurban->status_pembayaran === 'sudah_bayar' ? 'bg-green-200 text-green-800' :
                                               ($qurban->status_pembayaran === 'titip_panitia' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                            {{ str_replace('_', ' ', ucfirst($qurban->status_pembayaran)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('sohibul-qurban.edit', $qurban) }}"
                                           class="text-blue-500 hover:text-blue-700">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
