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

mysqli_query($conn, "SELECT id, legalitas FROM legalitas");

$sql = "SELECT id, legalitas FROM legalitas";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$id = $row['id'];
$legalitas = $row['legalitas'];
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
        <?php if (!empty($legalitas)) : ?>
            <p>Current File: <a href="../assets/pdf/legalitas/<?= htmlspecialchars(basename($legalitas)); ?>" target="_blank">View Current PDF</a></p>
            <iframe src="../assets/pdf/legalitas/<?= htmlspecialchars(basename($legalitas)); ?>" width="600" height="400"></iframe>
        <?php endif; ?>
        <input type="file" name="legalitas" id="legalitas" accept=".pdf"><br>
        <input type="submit" value="Update Legalitas">
    </form>
</body>

</html>