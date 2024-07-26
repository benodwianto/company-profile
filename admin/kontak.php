<?php
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $no_hp = $_POST['no_hp'];
    $no_wa = $_POST['no_wa'];
    $ig = $_POST['ig'];
    $fb = $_POST['fb'];
    $alamat = $_POST['alamat'];

    // Proses update data
    $resultMessage = updateKontak($id, $no_hp, $no_wa, $ig, $fb, $alamat);
    echo $resultMessage;

    // Redirect kembali ke halaman daftar kontak
    header("Location: kontak.php");
    exit();
}

$sql = "SELECT id, no_hp, no_wa, ig, fb, alamat FROM kontak";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Kontak</title>
</head>

<body>
    <h2>Update Kontak</h2>

    <form action="" method="post">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">

            <label for="no_hp">No HP:</label>
            <input type="text" name="no_hp" id="no_hp" value="<?= htmlspecialchars($row['no_hp']); ?>" required><br>

            <label for="no_wa">No WA:</label>
            <input type="text" name="no_wa" id="no_wa" value="<?= htmlspecialchars($row['no_wa']); ?>" required><br>

            <label for="ig">Instagram:</label>
            <input type="text" name="ig" id="ig" value="<?= htmlspecialchars($row['ig']); ?>" required><br>

            <label for="fb">Facebook:</label>
            <input type="text" name="fb" id="fb" value="<?= htmlspecialchars($row['fb']); ?>" required><br>

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" id="alamat" required><?= htmlspecialchars($row['alamat']); ?></textarea><br>
        <?php endwhile; ?>

        <input type="submit" value="Update Kontak">
    </form>
</body>

</html>