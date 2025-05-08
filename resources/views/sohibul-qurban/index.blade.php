@section('title', 'Data Sohibul Qurban')

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Data Sohibul Qurban
            </h2>
            <a href="{{ route('sohibul-qurban.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Tambah Data
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-init="setTimeout(() => show = false, 5000)"
                             class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded"
                             role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20">
                                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    <!-- Search and Filter Section -->
                    <div class="mb-6">
                        <form method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-4">
                            <!-- Search -->
                            <div class="col-span-1 md:col-span-2">
                                <x-input-label for="search" value="Cari" class="text-gray-300" />
                                <x-text-input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari nama, RT/RW, atau alamat..."
                                    class="w-full mt-1" />
                            </div>

                            <!-- Filter Jenis Hewan -->
                            <div>
                                <x-input-label for="jenis_hewan" value="Jenis Hewan" class="text-gray-300" />
                                <select name="jenis_hewan" class="w-full mt-1 text-gray-300 bg-gray-800 border-gray-700 rounded-md">
                                    <option value="">Semua</option>
                                    <option value="sapi" {{ request('jenis_hewan') == 'sapi' ? 'selected' : '' }}>Sapi</option>
                                    <option value="kambing" {{ request('jenis_hewan') == 'kambing' ? 'selected' : '' }}>Kambing</option>
                                </select>
                            </div>

                            <!-- Filter Status -->
                            <div>
                                <x-input-label for="status_pembayaran" value="Status" class="text-gray-300" />
                                <select name="status_pembayaran" class="w-full mt-1 text-gray-300 bg-gray-800 border-gray-700 rounded-md">
                                    <option value="">Semua</option>
                                    <option value="belum_bayar" {{ request('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="sudah_bayar" {{ request('status_pembayaran') == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                                    <option value="titip_panitia" {{ request('status_pembayaran') == 'titip_panitia' ? 'selected' : '' }}>Titip Panitia</option>
                                </select>
                            </div>

                            <div class="flex items-end col-span-1 md:col-span-4">
                                <x-primary-button type="submit">
                                    Filter
                                </x-primary-button>
                                @if(request()->hasAny(['search', 'jenis_hewan', 'status_pembayaran']))
                                    <a href="{{ route('sohibul-qurban.index') }}" class="px-4 py-2 ml-2 text-sm text-gray-300 underline">
                                        Reset Filter
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-2">
                                        <div class="flex items-center">
                                            Nama
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama_sohibul', 'direction' => request('sort') == 'nama_sohibul' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="ml-1">
                                                @if(request('sort') == 'nama_sohibul')
                                                    @if(request('direction') == 'asc')
                                                        ▲
                                                    @else
                                                        ▼
                                                    @endif
                                                @else
                                                    ↕
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th class="px-4 py-2">
                                        <div class="flex items-center">
                                            Qurban Untuk
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'qurban_untuk', 'direction' => request('sort') == 'qurban_untuk' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="ml-1">
                                                @if(request('sort') == 'qurban_untuk')
                                                    @if(request('direction') == 'asc')
                                                        ▲
                                                    @else
                                                        ▼
                                                    @endif
                                                @else
                                                    ↕
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th class="px-4 py-2">
                                        <div class="flex items-center">
                                            RT/RW
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'rt', 'direction' => request('sort') == 'rt' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="ml-1">
                                                @if(request('sort') == 'rt')
                                                    @if(request('direction') == 'asc')
                                                        ▲
                                                    @else
                                                        ▼
                                                    @endif
                                                @else
                                                    ↕
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th class="px-4 py-2">
                                        <div class="flex items-center">
                                            Jenis Hewan
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'jenis_hewan', 'direction' => request('sort') == 'jenis_hewan' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="ml-1">
                                                @if(request('sort') == 'jenis_hewan')
                                                    @if(request('direction') == 'asc')
                                                        ▲
                                                    @else
                                                        ▼
                                                    @endif
                                                @else
                                                    ↕
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th class="px-4 py-2">
                                        <div class="flex items-center">
                                            Status
                                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'status_pembayaran', 'direction' => request('sort') == 'status_pembayaran' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="ml-1">
                                                @if(request('sort') == 'status_pembayaran')
                                                    @if(request('direction') == 'asc')
                                                        ▲
                                                    @else
                                                        ▼
                                                    @endif
                                                @else
                                                    ↕
                                                @endif
                                            </a>
                                        </div>
                                    </th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($qurbanData as $data)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $data->nama_sohibul }}</td>
                                        <td class="px-4 py-2">{{ $data->qurban_untuk }}</td>
                                        <td class="px-4 py-2">{{ $data->rt }}/{{ $data->rw }}</td>
                                        <td class="px-4 py-2">
                                            {{ ucfirst($data->jenis_hewan) }}
                                            @if($data->jenis_hewan === 'sapi')
                                                <span class="ml-1 text-xs">
                                                    ({{ $data->is_collective ? 'Kolektif' : 'Individual' }})
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 rounded text-sm
                                                {{ $data->status_pembayaran === 'sudah_bayar' ? 'bg-green-200 text-green-800' :
                                                   ($data->status_pembayaran === 'titip_panitia' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                                {{ str_replace('_', ' ', ucfirst($data->status_pembayaran)) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('sohibul-qurban.edit', $data) }}"
                                                   class="px-3 py-1 text-sm font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">
                                                    Edit
                                                </a>
                                                <form action="{{ route('sohibul-qurban.destroy', $data) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-3 py-1 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-700"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $qurbanData->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
