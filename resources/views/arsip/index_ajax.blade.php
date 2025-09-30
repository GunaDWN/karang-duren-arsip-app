<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Arsip') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Daftar Arsip</h1>
                        <button id="tambah-arsip-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Arsip Baru
                        </button>
                    </div>
                    
                    <div id="notification-area"></div>
                    
                    <!-- Form tambah arsip (akan muncul saat tombol ditekan) -->
                    <div id="form-container" class="mb-6" style="display: none;">
                        <div class="bg-gray-50 p-6 rounded-lg mb-6">
                            <h2 class="text-xl font-semibold mb-4">Tambah Arsip Baru</h2>
                            
                            <form id="arsip-form" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="nomor_surat" class="block text-gray-700 text-sm font-bold mb-2">Nomor Surat:</label>
                                        <input type="text" name="nomor_surat" id="nomor_surat" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                               required>
                                    </div>
                                    
                                    <div>
                                        <label for="tanggal" class="block text-gray-700 text-sm font-bold mb-2">Tanggal:</label>
                                        <input type="date" name="tanggal" id="tanggal" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                               required>
                                    </div>
                                    
                                    <div>
                                        <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul:</label>
                                        <input type="text" name="judul" id="judul" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                               required>
                                    </div>
                                    
                                    <div>
                                        <label for="kategori_id" class="block text-gray-700 text-sm font-bold mb-2">Kategori:</label>
                                        <select name="kategori_id" id="kategori_id" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                                required>
                                            <option value="">Pilih Kategori</option>
                                            <!-- Kategori akan diisi dengan AJAX -->
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="file" class="block text-gray-700 text-sm font-bold mb-2">File:</label>
                                    <input type="file" name="file" id="file" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                           required>
                                    <p class="text-gray-500 text-xs mt-1">Format: PDF, DOC, DOCX, JPG, JPEG, PNG. Maksimal 10MB.</p>
                                </div>
                                
                                <div class="flex items-center justify-end space-x-2">
                                    <button type="button" id="batal-form-btn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Batal
                                    </button>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Surat</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="arsip-table-body" class="bg-white divide-y divide-gray-200">
                                <!-- Data akan diisi dengan AJAX -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="loading" class="text-center py-8" style="display: none;">
                        <p class="text-gray-500">Memuat data...</p>
                    </div>
                    
                    <div id="empty-state" class="text-center py-8" style="display: none;">
                        <p class="text-gray-500">Tidak ada arsip ditemukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            // Muat data kategori ke dropdown
            loadKategori();
            
            // Muat data arsip
            loadArsip();
            
            // Event untuk tombol tambah arsip
            $('#tambah-arsip-btn').click(function() {
                $('#form-container').show();
                $('#tambah-arsip-btn').hide();
            });
            
            // Event untuk tombol batal
            $('#batal-form-btn').click(function() {
                $('#form-container').hide();
                $('#tambah-arsip-btn').show();
                $('#arsip-form')[0].reset();
            });
            
            // Event untuk submit form arsip
            $('#arsip-form').submit(function(e) {
                createArsip(e);
            });
        });
        
        // Fungsi untuk memuat data kategori
        function loadKategori() {
            $.get('/api/kategori', function(data) {
                let options = '<option value="">Pilih Kategori</option>';
                data.forEach(function(kategori) {
                    options += `<option value="${kategori.id}">${kategori.nama}</option>`;
                });
                $('#kategori_id').html(options);
            });
        }
        
        // Fungsi untuk memuat data arsip
        function loadArsip() {
            $('#loading').show();
            $('#arsip-table-body').empty();
            
            $.get('/api/arsip', function(data) {
                $('#loading').hide();
                
                if (data.length === 0) {
                    $('#empty-state').show();
                } else {
                    $('#empty-state').hide();
                    data.forEach(function(arsip) {
                        const row = `
                            <tr id="arsip-row-${arsip.id}">
                                <td class="px-6 py-4 whitespace-nowrap">${arsip.nomor_surat}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${arsip.judul}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${arsip.tanggal}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${arsip.kategori.nama}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="/arsip/${arsip.id}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                        <a href="/arsip/${arsip.id}/edit" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                        <a href="/arsip/${arsip.id}/download" class="text-green-600 hover:text-green-900">Download</a>
                                        <button onclick="deleteArsip(${arsip.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        $('#arsip-table-body').append(row);
                    });
                }
            });
        }
        
        // Fungsi untuk menampilkan pesan sukses/error
        function showNotification(message, type = 'success') {
            if (type === 'success') {
                Toastify({
                    text: message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#10b981",
                    }
                }).show();
            } else {
                Toastify({
                    text: message,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#ef4444",
                    }
                }).show();
            }
        }
        
        // Fungsi untuk membuat arsip baru dengan AJAX
        function createArsip(e) {
            e.preventDefault();
            
            const formData = new FormData($('#arsip-form')[0]);
            
            $.ajax({
                url: '/arsip',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showNotification('Arsip berhasil ditambahkan!');
                    $('#arsip-form')[0].reset();
                    
                    // Tambahkan baris baru ke tabel
                    const newRow = `
                        <tr id="arsip-row-${response.id}">
                            <td class="px-6 py-4 whitespace-nowrap">${response.nomor_surat}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${response.judul}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${response.tanggal}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${response.kategori.nama}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="/arsip/${response.id}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                    <a href="/arsip/${response.id}/edit" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <a href="/arsip/${response.id}/download" class="text-green-600 hover:text-green-900">Download</a>
                                    <button onclick="deleteArsip(${response.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                    
                    $('#arsip-table-body').prepend(newRow);
                    
                    // Sembunyikan form setelah berhasil
                    $('#form-container').hide();
                    $('#tambah-arsip-btn').show();
                    
                    // Update jumlah arsip di dashboard jika ada
                    if ($('#total-arsip').length) {
                        let totalArsip = parseInt($('#total-arsip').text());
                        $('#total-arsip').text(totalArsip + 1);
                    }
                    
                    // Tampilkan pesan jika ada area notifikasi
                    if ($('#notification-area').length) {
                        $('#notification-area').html(`
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                ${response.message || 'Arsip berhasil ditambahkan.'}
                            </div>
                        `);
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    
                    if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else {
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '\n';
                        });
                    }
                    
                    showNotification(errorMessage, 'error');
                }
            });
        }
        
        // Fungsi untuk menghapus arsip dengan AJAX
        function deleteArsip(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan arsip ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/arsip/${id}`,
                        type: 'POST',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            showNotification('Arsip berhasil dihapus!');
                            // Hapus baris dari tabel
                            $(`#arsip-row-${id}`).remove();
                            
                            // Update jumlah arsip di dashboard jika ada
                            if ($('#total-arsip').length) {
                                let totalArsip = parseInt($('#total-arsip').text());
                                $('#total-arsip').text(totalArsip - 1);
                            }
                            
                            // Tampilkan pesan jika tabel kosong
                            if ($('#arsip-table-body tr').length === 0) {
                                $('#empty-state').show();
                            }
                            
                            // Tampilkan pesan jika ada area notifikasi
                            if ($('#notification-area').length) {
                                $('#notification-area').html(`
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                        ${response.message || 'Arsip berhasil dihapus.'}
                                    </div>
                                `);
                            }
                        },
                        error: function(xhr) {
                            showNotification('Terjadi kesalahan saat menghapus arsip!', 'error');
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                showNotification(xhr.responseJSON.message, 'error');
                            }
                        }
                    });
                }
            });
        }
    </script>
</x-app-layout>