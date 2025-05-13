@section('title', 'Data Pengeluaran')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Data Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-semibold">Daftar Pengeluaran</h3>
                        <a href="{{ route('pengeluaran.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Pengeluaran</a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                                <tr class="bg-gray-700">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Bukti</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($pengeluarans as $index => $pengeluaran)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pengeluaran->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">{{ $pengeluaran->keterangan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ $pengeluaran->bukti_path }}" target="_blank" class="text-blue-500 hover:text-blue-600">Lihat Bukti</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-700">
                                    <td colspan="3" class="px-6 py-3 text-right font-medium">Total Pengeluaran:</td>
                                    <td colspan="2" class="px-6 py-3 font-medium">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
