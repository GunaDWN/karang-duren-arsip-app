<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Arsip') }}
            </h2>
            <div class="text-sm text-gray-500">
                ID: {{ $arsip->id }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Arsip</h1>
                        <p class="text-gray-600">Perbarui informasi arsip surat</p>
                    </div>

                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        <!-- Form Section -->
                        <div class="xl:col-span-2">
                            <form action="{{ route('arsip.update', $arsip->id) }}" method="POST"
                                enctype="multipart/form-data" id="arsipForm">
                                @csrf
                                @method('PUT')

                                <!-- Grid untuk form fields -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Nomor Surat -->
                                    <div class="md:col-span-2">
                                        <label for="nomor_surat"
                                            class="block text-sm font-medium text-gray-700 mb-2">Nomor Surat</label>
                                        <input type="text" name="nomor_surat" id="nomor_surat"
                                            value="{{ old('nomor_surat', $arsip->nomor_surat) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('nomor_surat') border-red-500 @enderror"
                                            placeholder="Masukkan nomor surat" required>
                                        @error('nomor_surat')
                                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Judul -->
                                    <div class="md:col-span-2">
                                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul
                                            Surat</label>
                                        <input type="text" name="judul" id="judul"
                                            value="{{ old('judul', $arsip->judul) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('judul') border-red-500 @enderror"
                                            placeholder="Masukkan judul surat" required>
                                        @error('judul')
                                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Tanggal -->
                                    <div>
                                        <label for="tanggal"
                                            class="block text-sm font-medium text-gray-700 mb-2">Tanggal Surat</label>
                                        <input type="date" name="tanggal" id="tanggal"
                                            value="{{ old('tanggal', $arsip->tanggal->format('Y-m-d')) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('tanggal') border-red-500 @enderror"
                                            required>
                                        @error('tanggal')
                                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Kategori -->
                                    <div>
                                        <label for="kategori_id"
                                            class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                        <select name="kategori_id" id="kategori_id"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('kategori_id') border-red-500 @enderror"
                                            required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('kategori_id', $arsip->kategori_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="mt-6">
                                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File Baru
                                        (Opsional)</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="file"
                                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik
                                                        untuk upload</span> atau drag and drop</p>
                                                <p class="text-xs text-gray-500">PDF, DOC, DOCX, JPG, JPEG, PNG (MAX.
                                                    10MB)</p>
                                            </div>
                                            <input id="file" name="file" type="file" class="hidden"
                                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" />
                                        </label>
                                    </div>
                                    @error('file')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror

                                    <!-- File Info -->
                                    @if ($arsip->file_path)
                                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                            <p class="text-sm font-medium text-gray-700 mb-2">File Saat Ini:</p>
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    <span
                                                        class="text-sm text-gray-600">{{ basename($arsip->file_path) }}</span>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('arsip.download', $arsip->id) }}"
                                                        class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between pt-6 border-t border-gray-200 mt-6">
                                    <a href="{{ route('arsip.index') }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-lg font-semibold text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        Kembali
                                    </a>
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Preview Section -->
                        <div class="xl:col-span-1">
                            <div class="sticky top-6 space-y-6">
                                <!-- Document Preview -->
                                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-900">Preview Dokumen</h3>
                                    </div>
                                    <div class="p-4">
                                        @if ($arsip->file_path)
                                            @php
                                                $extension = pathinfo($arsip->file_path, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($extension), [
                                                    'jpg',
                                                    'jpeg',
                                                    'png',
                                                    'gif',
                                                ]);
                                                $isPdf = strtolower($extension) === 'pdf';
                                                $fileUrl = route('arsip.preview', $arsip->id);
                                            @endphp

                                            @if ($isImage)
                                                <!-- Image Preview -->
                                                <div class="text-center">
                                                    <img src="{{ $fileUrl }}" alt="Preview dokumen"
                                                        class="w-full h-auto rounded-lg shadow-sm max-h-64 object-contain">
                                                    <p class="text-sm text-gray-500 mt-2">Gambar -
                                                        {{ strtoupper($extension) }}</p>
                                                </div>
                                            @elseif($isPdf)
                                                <!-- PDF Preview dengan Embed -->
                                                <div class="space-y-3">
                                                    <div class="flex justify-between items-center">
                                                        <span class="text-sm font-medium text-gray-700">PDF
                                                            Preview</span>
                                                        <a href="{{ $fileUrl }}"
                                                            class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                            Download
                                                        </a>
                                                    </div>
                                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                                        <iframe
                                                            src="{{ $fileUrl }}#toolbar=1&navpanes=0&scrollbar=1"
                                                            width="100%" height="500"
                                                            style="border:none;"></iframe>
                                                        <p class="text-xs text-gray-500 text-center p-2 bg-gray-50">
                                                            Jika PDF tidak tampil, <a href="{{ $fileUrl }}"
                                                                class="text-blue-600 hover:text-blue-800">klik untuk
                                                                download</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                <!-- Other Document Preview -->
                                                <div class="text-center py-6">
                                                    <div class="bg-gray-50 p-6 rounded-lg">
                                                        <svg class="w-16 h-16 text-blue-500 mx-auto mb-4"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                        <p class="text-sm font-medium text-gray-900 mb-2">Dokumen
                                                            {{ strtoupper($extension) }}</p>
                                                        <p class="text-xs text-gray-500 mb-4">Format file tidak dapat
                                                            ditampilkan preview</p>
                                                        <a href="{{ $fileUrl }}"
                                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                            Download File
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <!-- No File Preview -->
                                            <div class="text-center py-8">
                                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-gray-500">Tidak ada file untuk dipreview</p>
                                                <p class="text-sm text-gray-400 mt-1">Upload file baru untuk melihat
                                                    preview</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Document Info -->
                                <div class="bg-white border border-gray-200 rounded-lg">
                                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                        <h4 class="text-sm font-medium text-gray-900">Informasi Dokumen</h4>
                                    </div>
                                    <div class="p-4">
                                        <dl class="space-y-3">
                                            <div class="flex justify-between items-center">
                                                <dt class="text-sm text-gray-500">Ukuran File:</dt>
                                                <dd class="text-sm text-gray-900 font-medium">
                                                    @if ($arsip->file_path && file_exists(public_path($arsip->file_path)))
                                                        {{ number_format(filesize(public_path($arsip->file_path)) / 1024, 2) }}
                                                        KB
                                                    @else
                                                        -
                                                    @endif
                                                </dd>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <dt class="text-sm text-gray-500">Format:</dt>
                                                <dd class="text-sm text-gray-900 font-medium">
                                                    @if ($arsip->file_path)
                                                        {{ strtoupper(pathinfo($arsip->file_path, PATHINFO_EXTENSION)) }}
                                                    @else
                                                        -
                                                    @endif
                                                </dd>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <dt class="text-sm text-gray-500">Dibuat:</dt>
                                                <dd class="text-sm text-gray-900 font-medium">
                                                    {{ $arsip->created_at->format('d/m/Y H:i') }}
                                                </dd>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <dt class="text-sm text-gray-500">Diubah:</dt>
                                                <dd class="text-sm text-gray-900 font-medium">
                                                    {{ $arsip->updated_at->format('d/m/Y H:i') }}
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // File upload preview
        document.getElementById('file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const preview = document.querySelector('#filePreview');
                const reader = new FileReader();

                reader.onload = function(e) {
                    const extension = file.name.split('.').pop().toLowerCase();
                    const isImage = ['jpg', 'jpeg', 'png', 'gif'].includes(extension);
                    const isPdf = extension === 'pdf';

                    let previewHtml = '';

                    if (isImage) {
                        previewHtml = `
                            <div class="text-center">
                                <img src="${e.target.result}" alt="Preview" class="w-full h-auto rounded-lg shadow-sm max-h-64 object-contain">
                                <p class="text-sm text-gray-500 mt-2">${file.name}</p>
                            </div>
                        `;
                    } else if (isPdf) {
                        previewHtml = `
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">PDF Preview</span>
                                    <span class="text-xs text-gray-500">Ukuran: ${(file.size / 1024).toFixed(2)} KB</span>
                                </div>
                                <div class="border border-gray-200 rounded-lg overflow-hidden">
                                    <div class="bg-gray-100 p-8 text-center">
                                        <svg class="w-12 h-12 text-red-500 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-sm text-gray-600">File PDF siap diupload</p>
                                        <p class="text-xs text-gray-400 mt-1">Preview akan tersedia setelah disimpan</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else {
                        previewHtml = `
                            <div class="text-center py-6">
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <svg class="w-16 h-16 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm font-medium text-gray-900 mb-2">${file.name}</p>
                                    <p class="text-xs text-gray-500 mb-2">Ukuran: ${(file.size / 1024).toFixed(2)} KB</p>
                                    <p class="text-xs text-gray-400">Format file tidak dapat ditampilkan preview</p>
                                </div>
                            </div>
                        `;
                    }

                    // Update preview section
                    const previewSection = document.querySelector('.xl\\:col-span-1 .bg-white.border');
                    if (previewSection) {
                        const previewContent = previewSection.querySelector('.p-4');
                        if (previewContent) {
                            previewContent.innerHTML = previewHtml;
                        }
                    }
                };

                if (isImage) {
                    reader.readAsDataURL(file);
                } else {
                    // Untuk file non-gambar, cukup tampilkan informasi
                    reader.readAsText(file.slice(0, 0)); // Hanya untuk memicu onload
                }
            }
        });

        // Validasi file size
        document.getElementById('file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const maxSize = 10 * 1024 * 1024; // 10MB

            if (file && file.size > maxSize) {
                alert('Ukuran file terlalu besar. Maksimal 10MB.');
                this.value = '';
            }
        });
    </script>
</x-app-layout>
