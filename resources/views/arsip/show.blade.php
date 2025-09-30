<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Arsip') }}
            </h2>
            <div class="text-sm text-gray-500">
                ID: {{ $arsip->id }}
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
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

            <div class="space-y-6">
                <!-- Document Info Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-2">Detail Arsip</h1>
                                <p class="text-gray-600">Informasi lengkap arsip surat</p>
                            </div>
                            <a href="{{ route('arsip.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-lg font-semibold text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar
                            </a>
                        </div>

                        <!-- Document Details -->
                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 block mb-1">Nomor Surat</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ $arsip->nomor_surat }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 block mb-1">Judul Surat</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ $arsip->judul }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 block mb-1">Tanggal
                                            Surat</label>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ $arsip->tanggal->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 block mb-1">Kategori</label>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $arsip->kategori->nama }}
                                        </span>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 block mb-1">Dibuat Pada</label>
                                        <p class="text-sm text-gray-900">{{ $arsip->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 block mb-1">Diperbarui
                                            Pada</label>
                                        <p class="text-sm text-gray-900">{{ $arsip->updated_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- File Information -->
                        @if ($arsip->file_path)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ basename($arsip->file_path) }}</p>
                                            <p class="text-sm text-gray-600">
                                                @if (file_exists(public_path($arsip->file_path)))
                                                    {{ number_format(filesize(public_path($arsip->file_path)) / 1024, 1) }}
                                                    KB
                                                @endif
                                                • {{ strtoupper(pathinfo($arsip->file_path, PATHINFO_EXTENSION)) }}
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('arsip.download', $arsip->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Download File
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('arsip.download', $arsip->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </a>

                            <a href="{{ route('arsip.edit', $arsip->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-lg font-semibold text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Arsip
                            </a>

                            <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus arsip ini?')"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Preview Section -->
                @if ($arsip->file_path)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-bold text-gray-900">Preview Dokumen</h3>
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    <span>Format:
                                        {{ strtoupper(pathinfo($arsip->file_path, PATHINFO_EXTENSION)) }}</span>
                                    @if (file_exists(public_path($arsip->file_path)))
                                        <span>•</span>
                                        <span>{{ number_format(filesize(public_path($arsip->file_path)) / 1024, 1) }}
                                            KB</span>
                                    @endif
                                </div>
                            </div>

                            @php
                                $extension = pathinfo($arsip->file_path, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                $isPdf = strtolower($extension) === 'pdf';
                                $fileUrl = route('arsip.preview', $arsip->id);
                            @endphp

                            @if ($isImage)
                                <!-- Image Preview -->
                                <div class="text-center bg-gray-50 rounded-lg p-4">
                                    <img src="{{ $fileUrl }}" alt="Preview dokumen"
                                        class="max-w-full h-auto rounded-lg shadow-sm mx-auto max-h-96 object-contain">
                                    <p class="text-sm text-gray-500 mt-2">Gambar - {{ strtoupper($extension) }}</p>
                                </div>
                            @elseif($isPdf)
                                <!-- PDF Preview dengan Iframe -->
                                <div class="space-y-4">
                                    <div class="border border-gray-200 rounded-lg overflow-hidden bg-white">
                                        <iframe src="{{ $fileUrl }}#toolbar=1&navpanes=0&scrollbar=1"
                                            width="100%" height="600" style="border:none;" class="w-full">
                                        </iframe>
                                    </div>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <p>Gunakan toolbar di atas untuk navigasi PDF</p>
                                        <a href="{{ $fileUrl }}"
                                            class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            Download PDF
                                        </a>
                                    </div>
                                </div>
                            @else
                                <!-- Other Document Preview -->
                                <div class="text-center bg-gray-50 rounded-lg p-8">
                                    <svg class="w-20 h-20 text-blue-500 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-lg font-medium text-gray-900 mb-2">Dokumen
                                        {{ strtoupper($extension) }}</p>
                                    <p class="text-gray-500 mb-4">Format file tidak dapat ditampilkan preview</p>
                                    <a href="{{ $fileUrl }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Download File
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- No File Preview -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Preview Dokumen</h3>
                            <div class="text-center bg-gray-50 rounded-lg p-8">
                                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="text-gray-500 text-lg mb-2">Tidak ada file untuk dipreview</p>
                                <p class="text-gray-400">File belum diupload untuk arsip ini</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
