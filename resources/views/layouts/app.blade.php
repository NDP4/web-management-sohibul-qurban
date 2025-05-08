<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- FilePond -->
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <script>
            // Force dark mode
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';

            document.addEventListener('DOMContentLoaded', function() {
                // FilePond initialization
                FilePond.registerPlugin(FilePondPluginImagePreview);

                // Initialize all FilePond elements
                document.querySelectorAll('.filepond').forEach(element => {
                    const pond = FilePond.create(element, {
                        server: {
                            process: {
                                url: '/upload',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                ondata: (formData) => {
                                    const namaSohibul = document.getElementById('nama_sohibul');
                                    if (namaSohibul) {
                                        formData.append('sohibul_name', namaSohibul.value);
                                    }
                                    return formData;
                                }
                            },
                            revert: '/upload',
                            restore: null,
                            load: null,
                            fetch: null
                        },
                        name: 'bukti_transfer',
                        labelIdle: 'Seret & Lepas file atau <span class="filepond--label-action"> Pilih File</span>',
                        labelFileProcessing: 'Mengupload',
                        labelFileProcessingComplete: 'Upload Selesai',
                        labelTapToUndo: 'ketuk untuk membatalkan',
                        labelTapToCancel: 'ketuk untuk membatalkan',
                        labelFileWaitingForSize: 'menunggu ukuran',
                        labelFileSizeNotAvailable: 'Ukuran tidak tersedia',
                        labelFileLoading: 'Loading',
                        labelFileLoadError: 'Error during load',
                        acceptedFileTypes: ['image/*'],
                        maxFileSize: '3MB',
                        allowRevert: true,
                        instantUpload: true
                    });

                    // Add hidden input for Google Drive file ID
                    const form = element.closest('form');
                    if (form) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'drive_file_id';
                        form.appendChild(hiddenInput);

                        // Update hidden input when file is uploaded
                        element.addEventListener('FilePond:processfile', (e) => {
                            hiddenInput.value = e.detail.file.serverId;
                        });
                    }

                    // Event handlers for status changes
                    element.addEventListener('FilePond:addfile', (e) => {
                        console.log('File added', e.detail);
                    });

                    element.addEventListener('FilePond:error', (e) => {
                        console.error('FilePond error:', e.detail);
                    });
                });

                // Jenis Hewan and Payment Method handlers
                const jenisHewanSelect = document.getElementById('jenis_hewan');
                const tipeSapiContainer = document.getElementById('tipe_sapi_container');
                const statusPembayaranSelect = document.getElementById('status_pembayaran');
                const metodePembayaranContainer = document.getElementById('metode_pembayaran_container');
                const metodePembayaranSelect = document.getElementById('metode_pembayaran');
                const buktiTransferContainer = document.getElementById('bukti_transfer_container');

                if (jenisHewanSelect && tipeSapiContainer) {
                    jenisHewanSelect.addEventListener('change', function() {
                        tipeSapiContainer.classList.toggle('hidden', this.value === 'kambing');
                    });
                }

                if (statusPembayaranSelect && metodePembayaranContainer) {
                    statusPembayaranSelect.addEventListener('change', function() {
                        metodePembayaranContainer.classList.toggle('hidden', this.value !== 'sudah_bayar');
                        if (this.value !== 'sudah_bayar') {
                            metodePembayaranSelect.value = '';
                            if (buktiTransferContainer) {
                                buktiTransferContainer.classList.add('hidden');
                            }
                        }
                    });
                }

                if (metodePembayaranSelect && buktiTransferContainer) {
                    metodePembayaranSelect.addEventListener('change', function() {
                        buktiTransferContainer.classList.toggle('hidden', this.value !== 'transfer');
                    });
                }
            });
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-900">
        <div class="min-h-screen bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
