<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('About') }}
            </h2>
            <div class="text-sm text-gray-500">
                Sistem Arsip Digital
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <!-- Header Section -->
                    <div class="text-center mb-12">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">Tentang Aplikasi</h1>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                            Sistem manajemen arsip digital untuk menyimpan, mengelola, dan mencari dokumen surat dengan
                            efisien
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Developer Info -->
                        <div class="lg:col-span-1">
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-6 text-center">
                                <div class="mb-6 flex justify-center">
                                    <div
                                        class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white">
                                        <img src="{{ $pengembang['foto'] }}" alt="Foto Profil"
                                            class="w-full h-full object-scale-down">
                                    </div>
                                </div>

                                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $pengembang['nama'] }}</h2>
                                <p class="text-gray-600 mb-4">Pengembang Aplikasi</p>

                                <div class="space-y-3 text-left bg-white rounded-lg p-4 shadow-sm">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-500">NIM</span>
                                        <span
                                            class="text-sm font-semibold text-gray-900">{{ $pengembang['nim'] }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-500">Program Studi</span>
                                        <span
                                            class="text-sm font-semibold text-gray-900 text-right max-w-[150px] break-words">
                                            {{ $pengembang['prodi'] }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-sm font-medium text-gray-500">Tanggal</span>
                                        <span
                                            class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($pengembang['tanggal'])->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- App Info -->
                        <div class="lg:col-span-2">
                            <div class="space-y-8">
                                <!-- About App -->
                                <div class="bg-white border border-gray-200 rounded-xl p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <h2 class="text-xl font-semibold text-gray-900">Tentang Aplikasi</h2>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">
                                        Aplikasi Sistem Manajemen Arsip ini dikembangkan untuk memberikan solusi digital
                                        dalam pengelolaan dokumen surat.
                                        Dengan antarmuka yang intuitif dan fitur yang lengkap, aplikasi ini memudahkan
                                        pengguna dalam menyimpan,
                                        mengategorikan, dan menemukan dokumen dengan cepat dan efisien.
                                    </p>
                                </div>

                                <!-- Features -->
                                <div class="bg-white border border-gray-200 rounded-xl p-6">
                                    <div class="flex items-center mb-6">
                                        <div class="p-2 bg-green-100 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                </path>
                                            </svg>
                                        </div>
                                        <h2 class="text-xl font-semibold text-gray-900">Fitur Utama</h2>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div
                                            class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            <div class="p-1 bg-blue-100 rounded mt-1">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Upload Arsip</h3>
                                                <p class="text-sm text-gray-600">Unggah dokumen dengan format beragam
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            <div class="p-1 bg-green-100 rounded mt-1">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Manajemen Kategori</h3>
                                                <p class="text-sm text-gray-600">Kelompokkan arsip berdasarkan kategori
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            <div class="p-1 bg-purple-100 rounded mt-1">
                                                <svg class="w-4 h-4 text-purple-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Dashboard Statistik</h3>
                                                <p class="text-sm text-gray-600">Pantau data arsip dengan visual grafik
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            <div class="p-1 bg-yellow-100 rounded mt-1">
                                                <svg class="w-4 h-4 text-yellow-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Pencarian Cepat</h3>
                                                <p class="text-sm text-gray-600">Temukan dokumen dengan mudah</p>
                                            </div>
                                        </div>
                                        <div
                                            class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            <div class="p-1 bg-red-100 rounded mt-1">
                                                <svg class="w-4 h-4 text-red-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-900">Sistem Login</h3>
                                                <p class="text-sm text-gray-600">Keamanan data terjamin</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tech Stack -->
                                <div class="bg-white border border-gray-200 rounded-xl p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                            </svg>
                                        </div>
                                        <h2 class="text-xl font-semibold text-gray-900">Teknologi yang Digunakan</h2>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">Laravel</span>
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">MySQL</span>
                                        <span
                                            class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">JavaScript</span>
                                        <span
                                            class="px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">Tailwind
                                            CSS</span>
                                        <span
                                            class="px-3 py-1 bg-indigo-100 text-indigo-800 text-sm font-medium rounded-full">PHP</span>
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">HTML5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Note -->
                    <div class="mt-12 pt-8 border-t border-gray-200 text-center">
                        <p class="text-gray-600 text-sm">
                            &copy; {{ date('Y') }} Sistem Manajemen Arsip. Dibuat dengan ❤️ untuk kemudahan
                            pengelolaan dokumen digital.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
