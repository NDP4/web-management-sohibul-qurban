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
                        <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Qurban Untuk</th>
                                    <th class="px-4 py-2">RT/RW</th>
                                    <th class="px-4 py-2">Jenis Hewan</th>
                                    <th class="px-4 py-2">Status</th>
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
