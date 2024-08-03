<nav class="d-flex align-items-center">
    <div class="kiri-nav">
        <i id="toggle-aside" class="bi bi-list toggle-icon"></i>
        <h3 id="section-title">Dashboard</h3>
    </div>
    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
        <li class="topbar"><a href="../logout.php" class="nav-link">Logout</a></li>
        <li class="topbar dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="../../assets/images/profile.png" alt="User Image" width="50px" height="50px">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><button id="tambah-admin-btn" class="dropdown-item btn btn-primary"><a
                            href="HalamanTambahAdmin.php">Tambah Admin</a></button></li>
            </ul>
        </li>
    </ul>
</nav>