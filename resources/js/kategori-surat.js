// resources/js/kategori-surat.js

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
                    
                    // Update jumlah kategori
                    let totalKategori = parseInt($('#total-kategori').text());
                    $('#total-kategori').text(totalKategori - 1);
                },
                error: function(xhr) {
                    showNotification('Terjadi kesalahan saat menghapus kategori!', 'error');
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        showNotification(xhr.responseJSON.message, 'error');
                    }
                }
            });
        }
    });
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
            
            // Update jumlah kategori
            let totalKategori = parseInt($('#total-kategori').text());
            $('#total-kategori').text(totalKategori + 1);
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMessage = '';
            
            $.each(errors, function(key, value) {
                errorMessage += value[0] + '\n';
            });
            
            showNotification(errorMessage, 'error');
        }
    });
}