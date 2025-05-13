@section('title', 'Pembuatan Kwitansi')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            Pembuatan Kwitansi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     class="relative p-4 mb-6 text-sm text-green-400 bg-gray-800 rounded-lg"
                     role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20">
                            <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Form Pembuatan Kwitansi -->
            <div class="mb-6 overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        {{-- <h3 class="text-lg font-semibold">Buat Kwitansi Baru</h3> --}}
                        <div class="flex space-x-4">
                            <div>
                                <h4 class="mb-2 text-sm font-semibold">Data Sohibul</h4>
                                <div class="flex space-x-2">
                                    <a href="{{ route('sohibul-qurban.export.pdf') }}" class="px-3 py-2 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                                        Export PDF
                                    </a>
                                    <a href="{{ route('sohibul-qurban.export.excel') }}" class="px-3 py-2 text-sm text-white bg-green-600 rounded hover:bg-green-700">
                                        Export Excel
                                    </a>
                                </div>
                            </div>
                            <div>
                                <h4 class="mb-2 text-sm font-semibold">Data Keuangan</h4>
                                <div class="flex space-x-2">
                                    <a href="{{ route('keuangan.export.pdf') }}" class="px-3 py-2 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                                        Export PDF
                                    </a>
                                    <a href="{{ route('keuangan.export.excel') }}" class="px-3 py-2 text-sm text-white bg-green-600 rounded hover:bg-green-700">
                                        Export Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-4 text-lg font-semibold">Buat Kwitansi Baru</h3>
                    <form action="{{ route('kwitansi.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <div>
                                <x-input-label for="sohibul_qurban_id" value="Pilih Sohibul Qurban" class="text-gray-300" />
                                <select name="sohibul_qurban_id" id="sohibul_qurban_id" required
                                    class="block w-full mt-1 text-gray-300 bg-gray-800 border-gray-700 rounded-md focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="">Pilih Sohibul Qurban</option>
                                    @foreach($availableSohibul as $sohibul)
                                        <option value="{{ $sohibul->id }}">{{ $sohibul->nama_sohibul }} - {{ ucfirst($sohibul->jenis_hewan) }} {{ $sohibul->is_collective ? '(Kolektif)' : '(Individual)' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="tanggal_pembayaran" value="Tanggal Pembayaran" class="text-gray-300" />
                                <x-text-input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" required class="block w-full mt-1" />
                            </div>

                            <div>
                                <x-input-label for="nominal" value="Nominal Pembayaran" class="text-gray-300" />
                                <x-text-input type="number" name="nominal" id="nominal" required class="block w-full mt-1" min="0" step="1000" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-primary-button>
                                Buat Kwitansi
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Riwayat Kwitansi -->
            <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="mb-4 text-lg font-semibold">Riwayat Kwitansi</h3>
                    <div class="overflow-x-auto">
                        <table id="kwitansiTable" class="min-w-full divide-y divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-sm font-semibold text-left text-gray-300">No. Kwitansi</th>
                                    <th class="px-4 py-3 text-sm font-semibold text-left text-gray-300">Nama Sohibul</th>
                                    <th class="px-4 py-3 text-sm font-semibold text-left text-gray-300">Tanggal</th>
                                    <th class="px-4 py-3 text-sm font-semibold text-left text-gray-300">Nominal</th>
                                    <th class="px-4 py-3 text-sm font-semibold text-left text-gray-300">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($kwitansiHistory as $kwitansi)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-300">{{ $kwitansi->nomor_kwitansi }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-300">{{ $kwitansi->sohibulQurban->nama_sohibul }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-300">{{ $kwitansi->tanggal_pembayaran->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-300">Rp {{ number_format($kwitansi->nominal, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-300">
                                            <div class="flex space-x-3">
                                                <a href="{{ route('kwitansi.download', $kwitansi->id) }}"
                                                   class="text-blue-500 hover:text-blue-400">
                                                    Download
                                                </a>
                                                @if($kwitansi->bukti_transfer)
                                                <a href="https://drive.google.com/file/d/{{ $kwitansi->bukti_transfer }}/view"
                                                   target="_blank"
                                                   class="text-green-500 hover:text-green-400">
                                                    Lihat Bukti
                                                </a>
                                                @endif
                                            </div>
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

    <script>
        $(document).ready(function() {
            $('#kwitansiTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                },
                order: [[2, 'desc']], // Sort by date column (index 2) in descending order
                columnDefs: [
                    {
                        targets: 3, // Nominal column
                        render: function(data, type, row) {
                            if (type === 'sort') {
                                return data.replace(/[^\d]/g, ''); // Remove non-numeric characters for sorting
                            }
                            return data;
                        }
                    },
                    {
                        targets: 4, // Action column
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
</x-app-layout>
