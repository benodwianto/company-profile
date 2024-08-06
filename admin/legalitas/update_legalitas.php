<?php
session_start();
include '../../config/functions.php';

// Ambil ID dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $sertifikat = $_POST['sertifikat'];
    $fileInputName = 'legalitas';

    // Proses update data
    $resultMessage = updateLegalitas($id, $fileInputName, $sertifikat);
    exit();
}

// Ambil data legalitas dari database
$sql = "SELECT id, legalitas, sertifikat FROM legalitas WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($id, $legalitas, $sertifikat);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Legalitas</title>
</head>

<body>
    <h2>Update Legalitas</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">

        <label for="sertifikat">Sertifikat:</label>
        <input type="text" name="sertifikat" id="sertifikat" value="<?= htmlspecialchars($sertifikat); ?>" required><br>

        <label for="legalitas">Legalitas (PDF):</label>
        <?php if ($legalitas) : ?>
            <iframe src="../../assets/pdf/legalitas/<?= htmlspecialchars(basename($legalitas)); ?>" width="50%" height="400" frameborder="0"></iframe>
        <?php endif; ?>
        <input type="file" name="legalitas" id="legalitas" accept=".pdf"><br>

        <input type="submit" value="Update Legalitas">
    </form>

    <a href="legalitas_list.php">Back to List</a>
    <?php include '../dashboard/popup.php'; ?>
</body>

</html>