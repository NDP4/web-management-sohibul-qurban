@section('title', 'Edit Pengeluaran')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Edit Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('pengeluaran.update', $pengeluaran->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-input-label for="keterangan" value="Keterangan" class="text-gray-300" />
                                <x-text-input id="keterangan" name="keterangan" type="text" class="block w-full mt-1"
                                    value="{{ old('keterangan', $pengeluaran->keterangan) }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                            </div>

                            <div>
                                <x-input-label for="tanggal_pengeluaran" value="Tanggal Pengeluaran" class="text-gray-300" />
                                <x-text-input id="tanggal_pengeluaran" name="tanggal_pengeluaran" type="date" class="block w-full mt-1"
                                    value="{{ old('tanggal_pengeluaran', $pengeluaran->tanggal_pengeluaran) }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_pengeluaran')" />
                            </div>

                            <div>
                                <x-input-label for="jumlah" value="Jumlah (Rp)" class="text-gray-300" />
                                <x-text-input id="jumlah" name="jumlah" type="number" class="block w-full mt-1"
                                    value="{{ old('jumlah', $pengeluaran->jumlah) }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />
                            </div>

                            <div>
                                <x-input-label for="bukti" value="Bukti Pengeluaran (Opsional)" class="text-gray-300" />
                                <input type="file" name="bukti" id="bukti" class="filepond" accept="image/*, application/pdf" />
                                <x-input-error class="mt-2" :messages="$errors->get('bukti')" />
                                <input type="hidden" name="drive_file_id" />
                                @if($pengeluaran->bukti_path)
                                    <div class="mt-2">
                                        <a href="https://drive.google.com/file/d/{{ $pengeluaran->bukti_path }}/view" target="_blank" class="text-blue-500 hover:text-blue-600">
                                            Lihat Bukti Saat Ini
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center justify-start gap-4">
                                <x-primary-button id="submitBtn">
                                    {{ __('Simpan Perubahan') }}
                                </x-primary-button>
                                <a href="{{ route('pengeluaran.index') }}" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    {{ __('Kembali') }}
                                </a>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const submitBtn = document.getElementById('submitBtn');
                                    const form = document.querySelector('form');

                                    // FilePond event handler for optional file upload
                                    document.querySelector('.filepond').addEventListener('FilePond:processfile', (e) => {
                                        const fileId = e.detail.file.serverId;
                                        document.querySelector('input[name="drive_file_id"]').value = fileId;
                                    });
                                });
                            </script>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
