<?php
include '../../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sponsor = $_POST['sponsor'];
    $fileInputName = 'foto';

    $resultMessage = insertSponsor($sponsor, $fileInputName);
    echo $resultMessage;

    header("Location: sponsor.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insert Sponsor</title>
</head>

<body>
    <h2>Insert Sponsor</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="sponsor">Sponsor:</label>
        <input type="text" name="sponsor" id="sponsor" required><br>
        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png, .gif" required><br>
        <input type="submit" value="Insert Sponsor">
    </form>
</body>

</html>