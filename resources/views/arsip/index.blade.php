<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Arsip') }}
            </h2>
            <div class="text-sm text-gray-500">
                Total: <span id="total-arsip">{{ $arsip->count() }}</span> arsip
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Main Content Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header Section -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">Daftar Arsip</h1>
                            <p class="text-gray-600">Kelola semua arsip surat dalam sistem</p>
                        </div>
                        <a href="{{ route('arsip.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Arsip Baru
                        </a>
                    </div>

                    <!-- Search Section -->
                    <div class="mb-6">
                        <div class="relative rounded-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="search-input"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Cari arsip berdasarkan nomor surat, judul, atau kategori..."
                                autocomplete="off">
                        </div>
                    </div>

                    <!-- Loading Indicator -->
                    <div id="loading-indicator" class="hidden text-center py-8">
                        <div
                            class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm text-blue-700 transition ease-in-out duration-150">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-700"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Memuat data...
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div id="table-container">
                        @include('arsip.partials.table', ['arsip' => $arsip])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const tableContainer = document.getElementById('table-container');
            const loadingIndicator = document.getElementById('loading-indicator');
            const totalArsip = document.getElementById('total-arsip');
            let searchTimeout;

            // Fungsi pencarian dengan debounce
            searchInput.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                const searchTerm = e.target.value.trim();

                // Tampilkan loading indicator segera
                loadingIndicator.classList.remove('hidden');
                tableContainer.style.opacity = '0.5';

                searchTimeout = setTimeout(() => {
                    searchArsip(searchTerm);
                }, 500);
            });

            // Fungsi AJAX untuk pencarian
            function searchArsip(searchTerm = '') {
                // Buat URL dengan parameter search
                const url = '{{ route('api.arsip') }}' + (searchTerm ? `?search=${encodeURIComponent(searchTerm)}` :
                    '');

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Update table content
                        tableContainer.innerHTML = data.html;

                        // Update total count
                        if (totalArsip) {
                            totalArsip.textContent = data.total;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat memuat data'
                        });
                    })
                    .finally(() => {
                        // Sembunyikan loading indicator
                        loadingIndicator.classList.add('hidden');
                        tableContainer.style.opacity = '1';

                        // Pasang event listeners ke elemen yang baru
                        attachEventListeners();
                    });
            }

            // Fungsi untuk menambahkan event listener ke tombol delete dan download
            function attachEventListeners() {
                // SweetAlert untuk delete
                document.querySelectorAll('.delete-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data arsip akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Show loading before submit
                                Swal.fire({
                                    title: 'Menghapus...',
                                    text: 'Sedang menghapus data',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                // Submit form
                                this.submit();
                            }
                        });
                    });
                });

                // SweetAlert untuk download
                document.querySelectorAll('.download-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = this.href;
                        const fileName = this.getAttribute('data-filename') || 'file';

                        Swal.fire({
                            title: 'Download File',
                            text: `Anda akan mendownload file: ${fileName}`,
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Download',
                            cancelButtonText: 'Batal',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect ke URL download
                                window.location.href = url;
                            }
                        });
                    });
                });
            }

            // Inisialisasi event listeners pertama kali
            attachEventListeners();
        });
    </script>

    <style>
        .overflow-hidden::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-hidden::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .overflow-hidden::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .overflow-hidden::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        #table-container {
            transition: opacity 0.3s ease;
        }
    </style>
</x-app-layout>
