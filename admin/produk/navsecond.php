<?php
// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}

// Cek apakah admin memiliki status yang sesuai
$isAdmin = $_SESSION['status'] == 'Admin';
?>

<nav class="d-flex align-items-center">
    <div class="kiri-nav">
        <i id="toggle-aside" class="bi bi-list toggle-icon"></i>
        <h3 id="section-title">Dashboard</h3>
    </div>
    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
        <li class="topbar">
            <a href="../logout.php"
                class="nav-link btn btn-light border border-danger text-danger d-flex align-items-center p-2">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
        </li>


        <!-- Foto Profil -->
        <li class="topbar">
            <a href="#" class="nav-link" id="userDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="../../assets/images/profile.png" alt="User Image" width="50px" height="50px">
            </a>
            <?php if ($isAdmin) : ?>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a href="../dashboard/HalamanTambahAdmin.php" class="dropdown-item btn btn-primary">
                        Tambah Admin
                    </a>
                </li>
                <!-- Item menu lain di sini -->
            </ul>
            <?php endif; ?>
        </li>
    </ul>
</nav>