<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            Pembuatan Kwitansi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-6 text-sm text-green-400 bg-gray-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Pembuatan Kwitansi -->
            <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Buat Kwitansi Baru</h3>
                    <form action="{{ route('kwitansi.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <div>
                                <x-input-label for="sohibul_qurban_id" value="Pilih Sohibul Qurban" class="text-gray-300" />
                                <select name="sohibul_qurban_id" id="sohibul_qurban_id" required
                                    class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="">Pilih Sohibul Qurban</option>
                                    @foreach($availableSohibul as $sohibul)
                                        <option value="{{ $sohibul->id }}">{{ $sohibul->nama_sohibul }} - {{ ucfirst($sohibul->jenis_hewan) }} {{ $sohibul->is_collective ? '(Kolektif)' : '(Individual)' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-input-label for="tanggal_pembayaran" value="Tanggal Pembayaran" class="text-gray-300" />
                                <x-text-input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" required class="mt-1 block w-full" />
                            </div>

                            <div>
                                <x-input-label for="nominal" value="Nominal Pembayaran" class="text-gray-300" />
                                <x-text-input type="number" name="nominal" id="nominal" required class="mt-1 block w-full" min="0" step="1000" />
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
                    <h3 class="text-lg font-semibold mb-4">Riwayat Kwitansi</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-300">No. Kwitansi</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-300">Nama Sohibul</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-300">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-300">Nominal</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-300">Aksi</th>
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
                                            <a href="{{ route('kwitansi.download', $kwitansi->id) }}"
                                               class="text-blue-500 hover:text-blue-400">
                                                Download
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
