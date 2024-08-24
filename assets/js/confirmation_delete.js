// Sweet Alert
$(document).ready(function() {
    // Konfirmasi penghapusan menggunakan SweetAlert2
    $('body').on('click', '.delete-button', function(e) {
        e.preventDefault();

        var link = $(this).attr('href'); // Ambil URL penghapusan dari atribut href

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda tidak akan dapat memulihkan item ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href =
                    link; // Redirect ke URL penghapusan jika dikonfirmasi
            }
        });
    });
});