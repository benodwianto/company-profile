<?php
// Include database connection and necessary functions
include '../../config/functions.php';
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID from the form
    $id = $_POST['id'];

    // Get the form data
    $grade = $_POST['grade'];
    $harga = $_POST['harga'];
    $iuran = $_POST['iuran'];
    $bobot = $_POST['bobot'];
    $pengawasan = $_POST['pengawasan'];
    $aqad = $_POST['aqad'];
    $garansi = $_POST['garansi'];

    // Use the updateJenisSapi function to update the record
    $success = updateJenisSapi($id, $grade, $harga, $iuran, $bobot, $pengawasan, $aqad, $garansi);
}

$data = null;
if ($id) {
    // Pastikan menggunakan prepared statement untuk mencegah SQL injection
    $sql = "SELECT id, grade, harga, iuran, bobot, pengawasan, aqad, garansi FROM jenis_sapi WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

// Jika tidak ada data ditemukan, beri handling agar user tahu.
if (!$data) {
    echo "Data not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Jenis Sapi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Update Jenis Sapi</h2>

        <!-- Form to update Jenis Sapi -->
        <form method="POST">
            <!-- Hidden field for the ID -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">

            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" class="form-control" id="grade" name="grade" value="<?= htmlspecialchars($data['grade']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($data['harga']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="iuran" class="form-label">Iuran</label>
                <input type="text" class="form-control" id="iuran" name="iuran" value="<?= htmlspecialchars($data['iuran']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="bobot" class="form-label">Bobot</label>
                <input type="text" class="form-control" id="bobot" name="bobot" value="<?= htmlspecialchars($data['bobot']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="pengawasan" class="form-label">Pengawasan</label>
                <input type="text" class="form-control" id="pengawasan" name="pengawasan" value="<?= htmlspecialchars($data['pengawasan']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="aqad" class="form-label">Aqad</label>
                <input type="text" class="form-control" id="aqad" name="aqad" value="<?= htmlspecialchars($data['aqad']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="garansi" class="form-label">Garansi</label>
                <input type="text" class="form-control" id="garansi" name="garansi" value="<?= htmlspecialchars($data['garansi']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="HalamanJenisSapi.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>