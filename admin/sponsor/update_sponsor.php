<?php
include '../../config/functions.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No ID provided.");
}

$id = intval($_GET['id']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sponsor = $_POST['sponsor'];
    $fileInputName = 'foto';

    // Process update data
    $resultMessage = updateSponsor($id, $sponsor, $fileInputName);
    echo $resultMessage;

    // Redirect to sponsor list page or another relevant page
    header("Location: sponsor.php");
    exit();
}

// Fetch current data from database
$sql = "SELECT sponsor, foto FROM sponsor WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($sponsor, $foto);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Sponsor</title>
</head>

<body>
    <h2>Update Sponsor</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">

        <label for="sponsor">Sponsor Name:</label>
        <input type="text" name="sponsor" id="sponsor" value="<?= htmlspecialchars($sponsor); ?>" required><br>

        <label for="foto">Sponsor Photo (JPG, JPEG, PNG, GIF):</label>
        <?php if (!empty($foto)) : ?>
            <p>Current Photo: <img src="../../assets/images/sponsor/<?= htmlspecialchars(basename($foto)); ?>" alt="Current Sponsor Photo" width="100"></p>
        <?php endif; ?>
        <input type="file" name="foto" id="foto" accept=".jpg, .jpeg, .png, .gif"><br>

        <input type="submit" value="Update Sponsor">
    </form>
</body>

</html>