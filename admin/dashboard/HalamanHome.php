<?php
include '../../config/functions.php';
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['status'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Periksa apakah 'id' dan 'deskripsi_dashboard' ada dalam POST
    if (isset($_POST['id']) && isset($_POST['deskripsi_dashboard'])) {
        $id = $_POST['id'];
        $deskripsi_dashboard = $_POST['deskripsi_dashboard'];
        
        // Pastikan 'deskripsi_dashboard' tidak kosong
        if (!empty($deskripsi_dashboard)) {
            $updateSuccess = updateHome($id, $deskripsi_dashboard);
            if ($updateSuccess) {
                header('Location: HalamanHome.php'); // Redirect setelah update berhasil
                exit;
            } else {
                // Menampilkan pesan kesalahan jika update gagal
                echo $_SESSION['message'];
            }
        } else {
            echo "Deskripsi Home tidak boleh kosong.";
        }
    } else {
        echo "Data tidak lengkap.";
    }
}

// Mengambil semua data dari tabel home
$sql = "SELECT id, deskripsi_dashboard FROM home";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <?php include 'aside.php'; ?>
    <article class="contracted">
        <?php include '../dashboard/nav.php'; ?>
        <div class="container mt-1">
            <div class="content" style="padding-top: 100px">
                <div class="content-page" id="halaman-produk">
                    <div class="container mt-5">
                        <h5>Update Home</h5>
                        <!-- Form Pencarian Produk -->
                        <div class="mb-4">
                            <div class="card p-5">
                                <?php if ($result->num_rows > 0) : ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                <form action="HalamanHome.php" method="post">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                                    <label for="deskripsi_dashboard">Deskripsi Home</label>
                                    <textarea class="form-control" name="deskripsi_dashboard" rows="10"
                                        id="deskripsi_dashboard"><?= htmlspecialchars($row['deskripsi_dashboard']); ?></textarea><br>
                                    <button type="submit" class="btn btn-primary">Update Home</button>
                                </form>

                                <?php endwhile; ?>
                                <?php else : ?>
                                <p>No data found in the database.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </article>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/scriptDashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>