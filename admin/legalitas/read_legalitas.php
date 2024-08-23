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

<!-- <!DOCTYPE html>
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

</html> -->

<?php include '../dashboard/aside.php'; ?>

<article class="contracted">
    <?php include '../dashboard/nav.php'; ?>
    <div class="container ml-0">
        <div class="content">
            <h5 class="card-title ms-01 mb-4">Legalitas</h5>
            <div class="card p-5 shadow mb-5">
                <h5 class="mt-5">Daftar Legalitas</h5>

                <table class="table table-striped table-bordered mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Sertifikat</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataLegalitas as $legalitas) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($legalitas['sertifikat']); ?></td>

                                <td>
                                    <a href="../legalitas/read_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>"
                                        class="btn btn-secondary btn-sm">View</a>
                                    <a href="../legalitas/delete_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>"
                                        class="btn btn-danger btn-sm delete-button">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


</article>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/scriptDashboard.js"></script>

</body>

</html>