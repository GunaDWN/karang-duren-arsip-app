<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Arsip Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Tambah Arsip Baru</h1>
                    
                    <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nomor_surat" class="block text-gray-700 text-sm font-bold mb-2">Nomor Surat:</label>
                            <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md @error('nomor_surat') border-red-500 @enderror" 
                                   required>
                            @error('nomor_surat')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul:</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md @error('judul') border-red-500 @enderror" 
                                   required>
                            @error('judul')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal" class="block text-gray-700 text-sm font-bold mb-2">Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md @error('tanggal') border-red-500 @enderror" 
                                   required>
                            @error('tanggal')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="kategori_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                            <select name="kategori_id" id="kategori_id" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md @error('kategori_id') border-red-500 @enderror" 
                                    required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="file" class="block text-gray-700 text-sm font-bold mb-2">File:</label>
                            <input type="file" name="file" id="file" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md @error('file') border-red-500 @enderror" 
                                   required>
                            <p class="text-gray-500 text-xs mt-1">Format: PDF, DOC, DOCX, JPG, JPEG, PNG. Maksimal 10MB.</p>
                            @error('file')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <a href="{{ route('arsip.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>