<?php
include '../../config/functions.php';

$result = getAllData('sponsor');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Sponsor</title>
</head>

<body>
    <h2>Daftar Sponsor</h2>
    <a href="add_sponsor.php">Insert New Sponsor</a>
    <br><br>
    <table border="1">
        <tr>
            <th>Sponsor</th>
            <th>Foto</th>
            <th>Actions</th>
        </tr>
        <?php if (!empty($result)) : ?>
            <?php foreach ($result as $sponsor) : ?>
                <tr>
                    <td><?= htmlspecialchars($sponsor['sponsor']); ?></td>
                    <td><img src="../../assets/images/sponsor/<?= htmlspecialchars(basename($sponsor['foto'])); ?>" width="50" height="50"></td>
                    <td>
                        <a href="update_sponsor.php?id=<?= $sponsor['id']; ?>">Update</a>
                        <a href="delete_sponsor.php?id=<?= $sponsor['id']; ?>" onclick="return confirm('Are you sure you want to delete this sponsor?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="3">No sponsors found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>