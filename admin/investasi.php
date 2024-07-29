<?php
include '../config/functions.php'; // Meng-include file fungsi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $jangka_investasi = $_POST['jangka_investasi'];
    $jlh_investasi = $_POST['jlh_investasi'];

    // Periksa apakah ada file yang di-upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoFileInputName = 'foto';
    } else {
        $fotoFileInputName = null; // Tidak ada file baru
    }

    // Proses update data
    $resultMessage = updateInvestasi($id, $jangka_investasi, $jlh_investasi, $fotoFileInputName);
}

$sql = "SELECT id, jangka_investasi, jlh_investasi, foto FROM investasi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Investasi</title>
</head>

<body>
    <h2>Update Investasi</h2>

    <!-- Menampilkan pesan hasil operasi -->
    <?php if (isset($resultMessage)) : ?>
        <p><?= htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>

    <!-- Menampilkan formulir input untuk setiap entri Investasi -->
    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                <label for="jangka_investasi">jangka investasi:</label>
                <input type="text" name="jangka_investasi" id="jangka_investasi" value="<?= htmlspecialchars($row['jangka_investasi']); ?>"><br>
                <label for="jlh_investasi">jlh_investasi:</label>
                <input type="text" name="jlh_investasi" id="jlh_investasi" value="<?= htmlspecialchars($row['jlh_investasi']); ?>"><br>
                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto"> <img src="../assets/images/investasi/<?= htmlspecialchars(basename($row['foto'])); ?>" alt="foto investasi" width="50" height="50">
                <br>
                <input type="submit" value="Update investasi">
            </form>
            <hr>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No data found in the database.</p>
    <?php endif; ?>
</body>

</html>