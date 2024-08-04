<div class="content-page" id="halaman-add-legalitas" style="display: none;">
    <div class="container mt-5">
        <h2>Insert Legalitas</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="legalitas">Legalitas (PDF):</label>
            <input type="file" name="legalitas" id="legalitas" accept=".pdf">

            <label for="sertifikat">Sertifikat:</label>
            <input type="text" name="sertifikat" id="sertifikat">

            <input type="submit" value="Insert Legalitas">
        </form>

        <?php
        include '../../config/functions.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fileInputNameLegalitas = 'legalitas';
            $sertifikat = $_POST['sertifikat'];

            // Proses insert data
            $resultMessage = insertLegalitas($fileInputNameLegalitas, $sertifikat);
            echo "<div class='message'>$resultMessage</div>";
        }
        ?>
    </div>
</div>