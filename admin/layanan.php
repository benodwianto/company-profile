<?php
include '../config/functions.php'; // Meng-include file fungsi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $investasi = $_POST['investasi'];
    $kelebihan = $_POST['kelebihan'];

    // Periksa apakah ada file yang di-upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoFileInputName = 'foto';
    } else {
        $fotoFileInputName = null; // Tidak ada file baru
    }

    // Proses update data
    $resultMessage = updateLayanan($id, $kelebihan, $investasi, $fotoFileInputName);
}

$sql = "SELECT id, kelebihan, investasi, foto FROM layanan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Layanan</title>
</head>

<body>
    <h2>Update Layanan</h2>

    <!-- Menampilkan pesan hasil operasi -->
    <?php if (isset($resultMessage)) : ?>
        <p><?= htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>

    <!-- Menampilkan formulir input untuk setiap entri layanan -->
    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <form action="layanan.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                <label for="kelebihan">kelebihan:</label>
                <input type="text" name="kelebihan" id="kelebihan" value="<?= htmlspecialchars($row['kelebihan']); ?>"><br>
                <label for="investasi">Investasi:</label>
                <input type="text" name="investasi" id="investasi" value="<?= htmlspecialchars($row['investasi']); ?>"><br>
                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto"> <img src="../assets/images/layanan/<?= htmlspecialchars(basename($row['foto'])); ?>" alt="foto layanan" width="50" height="50">
                <br>
                <input type="submit" value="Update Layanan">
            </form>
            <hr>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No data found in the database.</p>
    <?php endif; ?>
</body>

</html>