// resources/js/arsip.js

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
                    
                    // Update jumlah arsip
                    let totalArsip = parseInt($('#total-arsip').text());
                    $('#total-arsip').text(totalArsip - 1);
                },
                error: function(xhr) {
                    showNotification('Terjadi kesalahan saat menghapus arsip!', 'error');
                }
            });
        }
    });
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
            
            // Update jumlah arsip
            let totalArsip = parseInt($('#total-arsip').text());
            $('#total-arsip').text(totalArsip + 1);
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