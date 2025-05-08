@section('title', 'Tambah Data Sohibul Qurban')

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-100">
            Tambah Data Sohibul Qurban
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form action="{{ route('sohibul-qurban.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Nama Sohibul -->
                            <div>
                                <x-input-label for="nama_sohibul" value="Nama Sohibul Qurban" class="text-gray-300" />
                                <x-text-input id="nama_sohibul" name="nama_sohibul" type="text" class="block w-full mt-1" required
                                    value="{{ old('nama_sohibul') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_sohibul')" />
                            </div>

                            <!-- Qurban Untuk -->
                            <div>
                                <x-input-label for="qurban_untuk" value="Qurban Untuk" class="text-gray-300" />
                                <x-text-input id="qurban_untuk" name="qurban_untuk" type="text" class="block w-full mt-1"
                                    placeholder="Kosongkan jika sama dengan nama sohibul"
                                    value="{{ old('qurban_untuk') }}" />
                            </div>

                            <!-- RT -->
                            <div>
                                <x-input-label for="rt" value="RT" class="text-gray-300" />
                                <x-text-input id="rt" name="rt" type="text" class="block w-full mt-1"
                                    value="{{ old('rt') }}" />
                            </div>

                            <!-- RW -->
                            <div>
                                <x-input-label for="rw" value="RW" class="text-gray-300" />
                                <x-text-input id="rw" name="rw" type="text" class="block w-full mt-1"
                                    value="{{ old('rw') }}" />
                            </div>

                            <!-- Alamat -->
                            <div>
                                <x-input-label for="alamat" value="Alamat/Nomor Rumah" class="text-gray-300" />
                                <x-text-input id="alamat" name="alamat" type="text" class="block w-full mt-1"
                                    value="{{ old('alamat') }}" />
                            </div>

                            <!-- Nomor Telepon -->
                            <div>
                                <x-input-label for="nomor_telepon" value="Nomor Telepon" class="text-gray-300" />
                                <x-text-input id="nomor_telepon" name="nomor_telepon" type="text" class="block w-full mt-1"
                                    value="{{ old('nomor_telepon') }}" />
                            </div>

                            <!-- Status Pembayaran -->
                            <div>
                                <x-input-label for="status_pembayaran" value="Status Pembayaran" class="text-gray-300" />
                                <select name="status_pembayaran" id="status_pembayaran" required
                                    class="block w-full mt-1 text-gray-300 bg-gray-800 border-gray-700 rounded-md focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="belum_bayar" {{ old('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="sudah_bayar" {{ old('status_pembayaran') == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                                    <option value="titip_panitia" {{ old('status_pembayaran') == 'titip_panitia' ? 'selected' : '' }}>Titip Panitia</option>
                                </select>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div id="metode_pembayaran_container" class="{{ old('status_pembayaran') != 'sudah_bayar' ? 'hidden' : '' }}">
                                <x-input-label for="metode_pembayaran" value="Metode Pembayaran" class="text-gray-300" />
                                <select name="metode_pembayaran" id="metode_pembayaran"
                                    class="block w-full mt-1 text-gray-300 bg-gray-800 border-gray-700 rounded-md focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>

                            <!-- Bukti Transfer -->
                            <div id="bukti_transfer_container" class="{{ old('metode_pembayaran') != 'transfer' ? 'hidden' : '' }}">
                                <x-input-label for="bukti_transfer" value="Bukti Transfer" class="text-gray-300" />
                                <input type="file"
                                    name="bukti_transfer"
                                    id="bukti_transfer"
                                    class="filepond"
                                    accept="image/*"
                                    data-max-file-size="3MB"
                                    data-max-files="1" />
                            </div>

                            <!-- Jenis Hewan -->
                            <div>
                                <x-input-label for="jenis_hewan" value="Jenis Hewan" class="text-gray-300" />
                                <select name="jenis_hewan" id="jenis_hewan" required
                                    class="block w-full mt-1 text-gray-300 bg-gray-800 border-gray-700 rounded-md focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="sapi" {{ old('jenis_hewan') == 'sapi' ? 'selected' : '' }}>Sapi</option>
                                    <option value="kambing" {{ old('jenis_hewan') == 'kambing' ? 'selected' : '' }}>Kambing</option>
                                </select>
                            </div>

                            <!-- Tipe Qurban Sapi -->
                            <div id="tipe_sapi_container" class="{{ old('jenis_hewan') == 'kambing' ? 'hidden' : '' }}">
                                <x-input-label for="is_collective" value="Tipe Qurban Sapi" class="text-gray-300" />
                                <select name="is_collective" id="is_collective"
                                    class="block w-full mt-1 text-gray-300 bg-gray-800 border-gray-700 rounded-md focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="1" {{ old('is_collective', '1') == '1' ? 'selected' : '' }}>Kolektif (7 Orang = 1 Sapi)</option>
                                    <option value="0" {{ old('is_collective') == '0' ? 'selected' : '' }}>Individual (1 Orang = 1 Sapi)</option>
                                </select>
                            </div>

                            <!-- Catatan -->
                            <div class="md:col-span-2">
                                <x-input-label for="catatan" value="Catatan" class="text-gray-300" />
                                <x-textarea-input name="catatan" id="catatan" rows="3" class="block w-full mt-1">{{ old('catatan') }}</x-textarea-input>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-x-6">
                            <a href="{{ route('sohibul-qurban.index') }}" class="text-sm font-semibold text-gray-300 hover:text-white">
                                Batal
                            </a>
                            <x-primary-button>
                                Simpan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
