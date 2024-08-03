<?php
include '../../config/functions.php';

// Ambil ID dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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
    <title>View Legalitas</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    iframe {
        border: none;
        width: 100%;
        height: 80vh;
    }
    </style>
</head>

<body>
    <h2>View Legalitas</h2>

    <label for="sertifikat">Sertifikat:</label>
    <input type="text" name="sertifikat" id="sertifikat" value="<?= htmlspecialchars($sertifikat); ?>" readonly><br><br>

    <label for="legalitas">Legalitas (PDF):</label>
    <?php if ($legalitas) : ?>
    <iframe src="../../assets/pdf/legalitas/<?= htmlspecialchars(basename($legalitas)); ?>" allow="fullscreen"></iframe>
    <?php else : ?>
    <p>No PDF file available.</p>
    <?php endif; ?>

    <br><br>
    <a href="legalitas.php">Back to List</a>
</body>

</html>