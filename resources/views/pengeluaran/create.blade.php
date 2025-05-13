@section('title', 'Tambah Pengeluaran')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            {{ __('Tambah Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('pengeluaran.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-input-label for="keterangan" value="Keterangan" class="text-gray-300" />
                                <x-text-input id="keterangan" name="keterangan" type="text" class="block w-full mt-1"
                                    value="{{ old('keterangan') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                            </div>

                            <div>
                                <x-input-label for="jumlah" value="Jumlah (Rp)" class="text-gray-300" />
                                <x-text-input id="jumlah" name="jumlah" type="number" class="block w-full mt-1"
                                    value="{{ old('jumlah') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />
                            </div>

                            <div>
                                <x-input-label for="bukti" value="Bukti Pengeluaran" class="text-gray-300" />
                                <input type="file" name="bukti" id="bukti" class="filepond" accept="image/*, application/pdf" required />
                                <x-input-error class="mt-2" :messages="$errors->get('bukti')" />
                                <input type="hidden" name="drive_file_id" />
                            </div>

                            <div class="flex items-center justify-start gap-4">
                                <x-primary-button id="submitBtn" disabled>
                                    {{ __('Simpan') }}
                                </x-primary-button>
                                <a href="{{ route('pengeluaran.index') }}" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md dark:text-gray-300 dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    {{ __('Kembali') }}
                                </a>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const submitBtn = document.getElementById('submitBtn');
                                    const form = document.querySelector('form');
                                    const keterangan = document.getElementById('keterangan');

                                    // Enable submit button only when file is uploaded and keterangan is filled
                                    function checkForm() {
                                        const driveFileId = document.querySelector('input[name="drive_file_id"]').value;
                                        const keteranganValue = keterangan.value.trim();
                                        submitBtn.disabled = !driveFileId || !keteranganValue;
                                    }

                                    keterangan.addEventListener('input', checkForm);
                                });
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
