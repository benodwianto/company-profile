<?php
// Include the necessary database connection
include '../../config/functions.php';

// Fetch all data from `jenis_sapi`
$sql = getAllData('jenis_sapi');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis Sapi List</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Data Jenis Sapi</h2>

        <!-- Display message (if any) -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type']; ?>">
                <?= $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Table to display jenis_sapi data -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Grade</th>
                    <th>Harga</th>
                    <th>Iuran</th>
                    <th>Bobot</th>
                    <th>Pengawasan</th>
                    <th>Aqad</th>
                    <th>Garansi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($sql) > 0): ?>
                    <?php foreach ($sql as $sapi): ?>
                        <tr>
                            <td><?= $sapi['id']; ?></td>
                            <td><?= $sapi['grade']; ?></td>
                            <td><?= $sapi['harga']; ?> jt</td>
                            <td><?= $sapi['iuran']; ?></td>
                            <td><?= $sapi['bobot']; ?></td>
                            <td><?= $sapi['pengawasan']; ?></td>
                            <td><?= $sapi['aqad']; ?></td>
                            <td><?= $sapi['garansi']; ?></td>
                            <td>
                                <!-- Action buttons for update and delete -->
                                <a href="edit_jenis_sapi.php?id=<?= $sapi['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>