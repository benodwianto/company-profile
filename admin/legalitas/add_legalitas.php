<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insert Legalitas</title>
</head>

<body>
    <h2>Insert Legalitas</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="legalitas">Legalitas (PDF):</label>
        <input type="file" name="legalitas" id="legalitas" accept=".pdf"><br>

        <label for="sertifikat">Sertifikat:</label>
        <input type="text" name="sertifikat" id="sertifikat"><br>

        <input type="submit" value="Insert Legalitas">
    </form>
</body>

</html>

<?php
include '../../config/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileInputNameLegalitas = 'legalitas';
    $sertifikat = $_POST['sertifikat'];

    // Proses insert data
    $resultMessage = insertLegalitas($fileInputNameLegalitas, $sertifikat);
    echo $resultMessage;
}
?>