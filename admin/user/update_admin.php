<?php
include '../config/functions.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Proses update data
    $resultMessage = updateAdmin($id, $username, $password);
}

$sql = "SELECT id, username FROM admin";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Admin</title>
</head>

<body>
    <h2>Update Admin</h2>

    <!-- Menampilkan pesan hasil operasi -->
    <?php if (isset($resultMessage)) : ?>
    <p><?= htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>

    <!-- Menampilkan formulir input untuk setiap entri admin -->
    <?php if ($result->num_rows > 0) : ?>
    <?php while ($row = $result->fetch_assoc()) : ?>
    <form action="update_admin.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($row['username']); ?>"
            required><br>
        <label for="password">Password (Leave blank if not changing):</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Update Admin">
    </form>
    <hr>
    <?php endwhile; ?>
    <?php else : ?>
    <p>No data found in the database.</p>
    <?php endif; ?>
</body>

</html>