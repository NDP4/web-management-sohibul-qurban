@section('title', 'Data Pengeluaran')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Data Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-semibold">Daftar Pengeluaran</h3>
                        <a href="{{ route('pengeluaran.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Tambah Pengeluaran</a>
                    </div>

                    @if(session('success'))
                        <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                                <tr class="bg-gray-700">
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-200 uppercase">No</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-200 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-200 uppercase">Keterangan</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-200 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-200 uppercase">Bukti</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-200 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($pengeluarans as $index => $pengeluaran)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ Carbon\Carbon::parse($pengeluaran->tanggal_pengeluaran)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">{{ $pengeluaran->keterangan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ $pengeluaran->bukti_path }}" target="_blank" class="text-blue-500 hover:text-blue-600">Lihat Bukti</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('pengeluaran.edit', $pengeluaran->id) }}" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                                            <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('pengeluaran.edit', $pengeluaran->id) }}" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                                            <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">Hapus</button>
                                            </form>
                                        </div>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-700">
                                    <td colspan="3" class="px-6 py-3 font-medium text-right">Total Pengeluaran:</td>
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
