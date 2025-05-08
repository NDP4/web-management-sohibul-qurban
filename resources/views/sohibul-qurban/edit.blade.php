@section('title', 'Edit Data Sohibul Qurban')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Edit Data Sohibul Qurban
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form action="{{ route('sohibul-qurban.update', $sohibulQurban) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Sohibul -->
                            <div>
                                <x-input-label for="nama_sohibul" value="Nama Sohibul Qurban" class="text-gray-300" />
                                <x-text-input id="nama_sohibul" name="nama_sohibul" type="text" class="mt-1 block w-full" required
                                    value="{{ old('nama_sohibul', $sohibulQurban->nama_sohibul) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_sohibul')" />
                            </div>

                            <!-- Qurban Untuk -->
                            <div>
                                <x-input-label for="qurban_untuk" value="Qurban Untuk" class="text-gray-300" />
                                <x-text-input id="qurban_untuk" name="qurban_untuk" type="text" class="mt-1 block w-full"
                                    placeholder="Kosongkan jika sama dengan nama sohibul"
                                    value="{{ old('qurban_untuk', $sohibulQurban->qurban_untuk) }}" />
                            </div>

                            <!-- RT -->
                            <div>
                                <x-input-label for="rt" value="RT" class="text-gray-300" />
                                <x-text-input id="rt" name="rt" type="text" class="mt-1 block w-full"
                                    value="{{ old('rt', $sohibulQurban->rt) }}" />
                            </div>

                            <!-- RW -->
                            <div>
                                <x-input-label for="rw" value="RW" class="text-gray-300" />
                                <x-text-input id="rw" name="rw" type="text" class="mt-1 block w-full"
                                    value="{{ old('rw', $sohibulQurban->rw) }}" />
                            </div>

                            <!-- Alamat -->
                            <div>
                                <x-input-label for="alamat" value="Alamat/Nomor Rumah" class="text-gray-300" />
                                <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full"
                                    value="{{ old('alamat', $sohibulQurban->alamat) }}" />
                            </div>

                            <!-- Nomor Telepon -->
                            <div>
                                <x-input-label for="nomor_telepon" value="Nomor Telepon" class="text-gray-300" />
                                <x-text-input id="nomor_telepon" name="nomor_telepon" type="text" class="mt-1 block w-full"
                                    value="{{ old('nomor_telepon', $sohibulQurban->nomor_telepon) }}" />
                            </div>

                            <!-- Status Pembayaran -->
                            <div>
                                <x-input-label for="status_pembayaran" value="Status Pembayaran" class="text-gray-300" />
                                <select name="status_pembayaran" id="status_pembayaran" required
                                    class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="belum_bayar" {{ old('status_pembayaran', $sohibulQurban->status_pembayaran) == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="sudah_bayar" {{ old('status_pembayaran', $sohibulQurban->status_pembayaran) == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                                    <option value="titip_panitia" {{ old('status_pembayaran', $sohibulQurban->status_pembayaran) == 'titip_panitia' ? 'selected' : '' }}>Titip Panitia</option>
                                </select>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div id="metode_pembayaran_container" class="{{ old('status_pembayaran', $sohibulQurban->status_pembayaran) != 'sudah_bayar' ? 'hidden' : '' }}">
                                <x-input-label for="metode_pembayaran" value="Metode Pembayaran" class="text-gray-300" />
                                <select name="metode_pembayaran" id="metode_pembayaran"
                                    class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="tunai" {{ old('metode_pembayaran', $sohibulQurban->metode_pembayaran) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="transfer" {{ old('metode_pembayaran', $sohibulQurban->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>

                            <!-- Bukti Transfer -->
                            <div id="bukti_transfer_container" class="{{ old('metode_pembayaran', $sohibulQurban->metode_pembayaran) != 'transfer' ? 'hidden' : '' }}">
                                <x-input-label for="bukti_transfer" value="Bukti Transfer" class="text-gray-300" />
                                <input type="file"
                                    name="bukti_transfer"
                                    id="bukti_transfer"
                                    class="filepond"
                                    accept="image/*"
                                    data-max-file-size="3MB"
                                    data-max-files="1"
                                    data-initial-files="{{ $sohibulQurban->bukti_transfer ? asset('storage/' . $sohibulQurban->bukti_transfer) : '' }}"/>
                            </div>

                            <!-- Jenis Hewan -->
                            <div>
                                <x-input-label for="jenis_hewan" value="Jenis Hewan" class="text-gray-300" />
                                <select name="jenis_hewan" id="jenis_hewan" required
                                    class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="sapi" {{ old('jenis_hewan', $sohibulQurban->jenis_hewan) == 'sapi' ? 'selected' : '' }}>Sapi</option>
                                    <option value="kambing" {{ old('jenis_hewan', $sohibulQurban->jenis_hewan) == 'kambing' ? 'selected' : '' }}>Kambing</option>
                                </select>
                            </div>

                            <!-- Tipe Qurban Sapi -->
                            <div id="tipe_sapi_container" class="{{ old('jenis_hewan', $sohibulQurban->jenis_hewan) == 'kambing' ? 'hidden' : '' }}">
                                <x-input-label for="is_collective" value="Tipe Qurban Sapi" class="text-gray-300" />
                                <select name="is_collective" id="is_collective"
                                    class="mt-1 block w-full rounded-md border-gray-700 bg-gray-800 text-gray-300 focus:border-indigo-600 focus:ring-indigo-600">
                                    <option value="1" {{ old('is_collective', $sohibulQurban->is_collective) ? 'selected' : '' }}>Kolektif (7 Orang = 1 Sapi)</option>
                                    <option value="0" {{ old('is_collective', !$sohibulQurban->is_collective) ? 'selected' : '' }}>Individual (1 Orang = 1 Sapi)</option>
                                </select>
                            </div>

                            <!-- Catatan -->
                            <div class="md:col-span-2">
                                <x-input-label for="catatan" value="Catatan" class="text-gray-300" />
                                <x-textarea-input name="catatan" id="catatan" rows="3" class="mt-1 block w-full">{{ old('catatan', $sohibulQurban->catatan) }}</x-textarea-input>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('sohibul-qurban.index') }}" class="text-sm font-semibold text-gray-300 hover:text-white">
                                Batal
                            </a>
                            <x-primary-button>
                                Simpan Perubahan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
