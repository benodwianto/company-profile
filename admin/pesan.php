<?php
include '../config/functions.php';

$sql = "SELECT id, pesan_pengunjung, email, tanggal FROM pesan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pesan</title>
</head>

<body>
    <h2>Daftar Pesan</h2>
    <a href="add_pesan.php">Insert New Pesan</a>
    <br><br>
    <table border="1">
        <tr>
            <th>Pesan Pengunjung</th>
            <th>Email</th>
            <th>Tanggal</th>
        </tr>
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['pesan_pengunjung']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr>
                <td colspan="4">No messages found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>