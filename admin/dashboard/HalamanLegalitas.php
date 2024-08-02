<?php

// Ambil semua data legalitas
$dataLegalitas = getAllLegalitas();

function getAllLegalitas()
{
    global $conn;
    $sql = "SELECT id, legalitas, sertifikat FROM legalitas";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileInputNameLegalitas = 'legalitas';
    $sertifikat = $_POST['sertifikat'];

    // Proses insert data
    $resultMessage = insertLegalitas($fileInputNameLegalitas, $sertifikat);
    echo "<div class='message'>$resultMessage</div>";
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Pastikan jQuery dimuat -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    /* Styling sesuai dengan yang diberikan */
    .container-legalitas {
        max-width: 800px;
        margin: auto;
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .file-upload-wrapper {
        display: flex;
        align-items: center;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 10px;
        background-color: #f9f9f9;
    }

    .pdf-icon {
        width: 50px;
        margin-right: 15px;
    }

    #legalitas-upload {
        border: none;
        outline: none;
    }

    .btn-dark {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn-dark:hover {
        background-color: #555;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    .container-legalitasth {
        background-color: #f2f2f2;
    }

    .file-upload-wrapper {
        display: flex;
        align-items: center;
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-file-upload {
        display: flex;
        align-items: center;
    }

    .pdf-icon {
        width: 50px;
        margin-right: 15px;
    }

    input[type="file"] {
        display: none;
    }

    .btn-file {
        background-color: white;
        color: #007bff;
        padding: 10px 20px;
        width: 133px;
        border-radius: 5px;
        cursor: pointer;
        border: 2px solid #007bff;
        text-align: center;
    }

    .btn-file:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .file-name {
        font-size: 14px;
        color: #888;
    }

    .legalitas {
        display: flex !important;
        flex-direction: column !important;
    }

    .chosen {
        margin-left: -60px;
        /* Sesuaikan nilai jika diperlukan */

        /* Memastikan elemen geser ke kiri jika ada ruang ekstra */
    }
    </style>
</head>

<body>
    <div class="content-page" id="halaman-legalitas">
        <div class="container-legalitas">
            <div class="card">
                <h2>Upload Legalitas</h2>
                <form id="upload-form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="file-upload-wrapper">
                            <div class="custom-file-upload d-flex align-items-center">
                                <div>
                                    <img src="../../assets/images/pdf-icon.png" alt="PDF Icon" class="pdf-icon">
                                </div>
                                <div class="legalitas d-block ml-1">
                                    <label for="legalitas-upload" class="form-label">Please upload only PDF
                                        format</label>
                                    <label for="legalitas-upload" class="btn-file">Choose File</label>
                                    <input type="file" id="legalitas-upload" name="legalitas" accept=".pdf"
                                        style="display: none;">
                                </div>
                                <div class="chosen mt-4 mr-500">
                                    <span class="file-name">No File Chosen</span>
                                </div>
                            </div>
                        </div>

                        <label for="sertifikat" class="form-label" style="margin-top: 20px;">Nama Sertifikat</label>
                        <div class="file-upload-wrapper">
                            <input type="text" name="sertifikat" id="sertifikat" class="form-control"
                                placeholder="Masukkan Nama Sertifikat">
                        </div>
                    </div>

                    <button type="submit" class="btn-dark">Simpan Perubahan</button>
                </form>
            </div>

            <h1>Legalitas List</h1>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sertifikat</th>
                        <th>Legalitas File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataLegalitas as $legalitas) : ?>
                    <tr>
                        <td><?= htmlspecialchars($legalitas['id']); ?></td>
                        <td><?= htmlspecialchars($legalitas['sertifikat']); ?></td>
                        <td>
                            <?php if (!empty($legalitas['legalitas'])) : ?>
                            <a href="legalitas_pdf.php?id=<?= htmlspecialchars($legalitas['id']); ?>"
                                target="_blank">Lihat PDF</a>
                            <?php else : ?>
                            No File
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="read_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>">View</a> |
                            <a href="update_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>">Update</a> |
                            <a href="../legalitas/delete_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>"
                                class="delete-button">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    document.getElementById("legalitas-upload").addEventListener("change", function() {
        var fileName = this.files[0] ? this.files[0].name : "No File Chosen";
        document.querySelector(".file-name").textContent = fileName;
    });

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
    </script>
</body>

</html>