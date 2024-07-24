<?php
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $deskripsi_dashboard = $_POST['deskripsi_dashboard'];
    echo updateHome($id, $deskripsi_dashboard);
}

// Mengambil semua data dari tabel home
$sql = "SELECT id, deskripsi_dashboard FROM home";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Home</title>
</head>

<body>
    <h2>Update Home</h2>
    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <form action="home.php" method="post">
                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                <label for="deskripsi_dashboard">Deskripsi Dashboard:</label>
                <textarea name="deskripsi_dashboard" id="deskripsi_dashboard"><?= $row['deskripsi_dashboard']; ?></textarea><br>
                <input type="submit" value="Update Home">
            </form>
            <hr>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No data found in the database.</p>
    <?php endif; ?>
</body>

</html>