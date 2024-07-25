<?php
include '../config/functions.php'; // Meng-include file fungsi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $deskripsi_tentang = $_POST['deskripsi_tentang'];

    // Periksa apakah ada file yang di-upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoFileInputName = 'foto';
    } else {
        $fotoFileInputName = null; // Tidak ada file baru
    }

    // Proses update data
    $resultMessage = updateTentang($id, $deskripsi_tentang, $fotoFileInputName);
}

$sql = "SELECT id, foto, deskripsi_tentang, foto FROM tentang";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update tentang</title>
</head>

<body>
    <h2>Update tentang</h2>

    <!-- Menampilkan pesan hasil operasi -->
    <?php if (isset($resultMessage)) : ?>
        <p><?= htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>

    <!-- Menampilkan formulir input untuk setiap entri tentang -->
    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <form action="tentang.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                <label for="deskripsi_tentang">deskripsi_tentang:</label>
                <input type="text" name="deskripsi_tentang" id="deskripsi_tentang" value="<?= htmlspecialchars($row['deskripsi_tentang']); ?>"><br>
                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto"> <img src="../assets/images/tentang/<?= htmlspecialchars(basename($row['foto'])); ?>" alt="foto tentang" width="50" height="50">
                <br>
                <input type="submit" value="Update tentang">
            </form>
            <hr>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No data found in the database.</p>
    <?php endif; ?>
</body>

</html>