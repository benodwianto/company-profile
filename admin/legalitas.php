<?php
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fileInputName = 'legalitas';

    // Proses update data
    $resultMessage = updateLegalitas($id, $fileInputName);
    echo $resultMessage;

    // Redirect kembali ke halaman daftar legalitas
    header("Location: legalitas.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT id, legalitas FROM legalitas WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($id, $legalitas);
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
        <label for="legalitas">Legalitas (PDF):</label>
        <?php if ($legalitas) : ?>
            <p>Current File: <a href="<?= htmlspecialchars($legalitas); ?>" target="_blank">View Current PDF</a></p>
        <?php endif; ?>
        <input type="file" name="legalitas" id="legalitas" accept=".pdf"><br>
        <input type="submit" value="Update Legalitas">
    </form>
</body>

</html>