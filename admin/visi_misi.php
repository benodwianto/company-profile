<?php
include '../config/functions.php'; // Meng-include file fungsi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];

    // Periksa apakah ada file yang di-upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoFileInputName = 'foto';
    } else {
        $fotoFileInputName = null; // Tidak ada file baru
    }

    // Proses update data
    $resultMessage = updateVisiMisi($id, $visi, $misi, $fotoFileInputName);
}

$sql = "SELECT id, visi, misi, foto FROM visi_misi";
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
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                <label for="visi">visi:</label>
                <input type="text" name="visi" id="visi" value="<?= htmlspecialchars($row['visi']); ?>"><br>

                <label for="misi">misi:</label>
                <input type="text" name="misi" id="misi" value="<?= htmlspecialchars($row['misi']); ?>"><br>

                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto"> <img src="../assets/images/visi_misi/<?= htmlspecialchars(basename($row['foto'])); ?>" alt="foto tentang" width="50" height="50">
                <br>
                <input type="submit" value="Update visi_misi">
            </form>
            <hr>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No data found in the database.</p>
    <?php endif; ?>
</body>

</html>