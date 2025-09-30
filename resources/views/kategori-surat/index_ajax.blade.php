<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Surat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Daftar Kategori Surat</h1>
                        <button id="tambah-kategori-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Kategori
                        </button>
                    </div>
                    
                    <div id="notification-area"></div>
                    
                    <!-- Form tambah kategori (akan muncul saat tombol ditekan) -->
                    <div id="form-container" class="mb-6" style="display: none;">
                        <div class="bg-gray-50 p-6 rounded-lg mb-6">
                            <h2 class="text-xl font-semibold mb-4">Tambah Kategori Surat Baru</h2>
                            
                            <form id="kategori-form">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori:</label>
                                    <input type="text" name="nama" id="nama" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                           required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="keterangan" class="block text-gray-700 text-sm font-bold mb-2">Keterangan:</label>
                                    <textarea name="keterangan" id="keterangan" rows="3" 
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
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
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="kategori-table-body" class="bg-white divide-y divide-gray-200">
                                <!-- Data akan diisi dengan AJAX -->
                            </tbody>
                        </table>
                    </div>
                    
                    <div id="loading" class="text-center py-8" style="display: none;">
                        <p class="text-gray-500">Memuat data...</p>
                    </div>
                    
                    <div id="empty-state" class="text-center py-8" style="display: none;">
                        <p class="text-gray-500">Tidak ada kategori ditemukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            // Muat data kategori
            loadKategori();
            
            // Event untuk tombol tambah kategori
            $('#tambah-kategori-btn').click(function() {
                $('#form-container').show();
                $('#tambah-kategori-btn').hide();
            });
            
            // Event untuk tombol batal
            $('#batal-form-btn').click(function() {
                $('#form-container').hide();
                $('#tambah-kategori-btn').show();
                $('#kategori-form')[0].reset();
            });
            
            // Event untuk submit form kategori
            $('#kategori-form').submit(function(e) {
                createKategori(e);
            });
        });
        
        // Fungsi untuk memuat data kategori
        function loadKategori() {
            $('#loading').show();
            $('#kategori-table-body').empty();
            
            $.get('/api/kategori', function(data) {
                $('#loading').hide();
                
                if (data.length === 0) {
                    $('#empty-state').show();
                } else {
                    $('#empty-state').hide();
                    data.forEach(function(kategori) {
                        const row = `
                            <tr id="kategori-row-${kategori.id}">
                                <td class="px-6 py-4 whitespace-nowrap">${kategori.nama}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${kategori.keterangan || '-'}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="/kategori-surat/${kategori.id}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                        <a href="/kategori-surat/${kategori.id}/edit" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                        <button onclick="deleteKategori(${kategori.id})" class="text-red-600 hover:text-red-900" ${kategori.arsip_count && kategori.arsip_count > 0 ? 'disabled title="Kategori ini masih digunakan"' : ''}>Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        $('#kategori-table-body').append(row);
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
        
        // Fungsi untuk membuat kategori baru dengan AJAX
        function createKategori(e) {
            e.preventDefault();
            
            const formData = new FormData($('#kategori-form')[0]);
            
            $.ajax({
                url: '/kategori-surat',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showNotification('Kategori berhasil ditambahkan!');
                    $('#kategori-form')[0].reset();
                    
                    // Tambahkan baris baru ke tabel
                    const newRow = `
                        <tr id="kategori-row-${response.id}">
                            <td class="px-6 py-4 whitespace-nowrap">${response.nama}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${response.keterangan || '-'}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="/kategori-surat/${response.id}" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                    <a href="/kategori-surat/${response.id}/edit" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <button onclick="deleteKategori(${response.id})" class="text-red-600 hover:text-red-900">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                    
                    $('#kategori-table-body').prepend(newRow);
                    
                    // Sembunyikan form setelah berhasil
                    $('#form-container').hide();
                    $('#tambah-kategori-btn').show();
                    
                    // Update jumlah kategori di dashboard jika ada
                    if ($('#total-kategori').length) {
                        let totalKategori = parseInt($('#total-kategori').text());
                        $('#total-kategori').text(totalKategori + 1);
                    }
                    
                    // Tampilkan pesan jika ada area notifikasi
                    if ($('#notification-area').length) {
                        $('#notification-area').html(`
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                ${response.message || 'Kategori berhasil ditambahkan.'}
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
        
        // Fungsi untuk menghapus kategori dengan AJAX
        function deleteKategori(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan kategori ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/kategori-surat/${id}`,
                        type: 'POST',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            showNotification('Kategori berhasil dihapus!');
                            // Hapus baris dari tabel
                            $(`#kategori-row-${id}`).remove();
                            
                            // Update jumlah kategori di dashboard jika ada
                            if ($('#total-kategori').length) {
                                let totalKategori = parseInt($('#total-kategori').text());
                                $('#total-kategori').text(totalKategori - 1);
                            }
                            
                            // Tampilkan pesan jika tabel kosong
                            if ($('#kategori-table-body tr').length === 0) {
                                $('#empty-state').show();
                            }
                            
                            // Tampilkan pesan jika ada area notifikasi
                            if ($('#notification-area').length) {
                                $('#notification-area').html(`
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                        ${response.message || 'Kategori berhasil dihapus.'}
                                    </div>
                                `);
                            }
                        },
                        error: function(xhr) {
                            showNotification('Terjadi kesalahan saat menghapus kategori!', 'error');
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