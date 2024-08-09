<?php
include '../../config/functions.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : null;
    $no_wa = isset($_POST['no_wa']) ? $_POST['no_wa'] : null;
    $ig = isset($_POST['ig']) ? $_POST['ig'] : null;
    $fb = isset($_POST['fb']) ? $_POST['fb'] : null;
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : null;



    // Proses update data
    $resultMessage = updateKontak($id, $no_hp, $no_wa, $ig, $fb, $alamat);
    echo $resultMessage;
    exit();
}

$sql = "SELECT id, no_hp, no_wa, ig, fb, alamat FROM kontak";
$result = $conn->query($sql);
?>

<?php include 'aside.php'; ?>
<article class="contracted">
    <?php include 'nav.php'; ?>
    <div class="container mt-5">
        <div class="content">
            <div class="content-page" id="halaman-kontak">
                <div class="card ms-4 shadow-sm">
                    <form action="" method="post" class="row g-3 p-4">
                        <?php while ($row = $result->fetch_assoc()) : ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">

                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">No HP:</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                value="<?= htmlspecialchars($row['no_hp']); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="no_wa" class="form-label">No WA:</label>
                            <input type="text" name="no_wa" id="no_wa" class="form-control"
                                value="<?= htmlspecialchars($row['no_wa']); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="ig" class="form-label">Instagram:</label>
                            <input type="text" name="ig" id="ig" class="form-control"
                                value="<?= htmlspecialchars($row['ig']); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="fb" class="form-label">Facebook:</label>
                            <input type="text" name="fb" id="fb" class="form-control"
                                value="<?= htmlspecialchars($row['fb']); ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <textarea name="alamat" id="alamat" class="form-control" rows="3"
                                required><?= htmlspecialchars($row['alamat']); ?></textarea>
                        </div>

                        <div class="col-12">
                            <input type="submit" value="Update Kontak" class="btn btn-primary">
                        </div>
                        <?php endwhile; ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</article>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/scriptDashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>