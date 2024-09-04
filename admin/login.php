<?php
session_start();
include '../config/functions.php';

// Jika user sudah login, redirect ke dashboard
if (isset($_SESSION['admin_id']) && isset($_SESSION['status'])) {
    header("Location: dashboard");
    exit();
}

include 'dashboard/popup.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = login($username, $password);

    if ($admin) {
        // Jika login berhasil, buat sesi
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['status'] = $admin['status'];

        // Arahkan ke halaman dashboard
        header("Location: dashboard");
        exit();
    } else {
        // Jika login gagal, beri pesan kesalahan
        $_SESSION['message'] = 'Username atau password salah.';
        $_SESSION['message_type'] = 'error';
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        max-width: 400px;
        width: 100%;
        padding: 20px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
        margin-bottom: 20px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #007bff;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form action="login.php" method="post" id="login-form">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="container text-center">
                <button type="submit" class="btn btn-primary"
                    style="background-color: #951C11; border-color: #951C11;">Login</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    <?php if (isset($_SESSION['message'])) : ?>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?= htmlspecialchars($_SESSION['message']); ?>',
    });
    <?php 
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            ?>
    <?php endif; ?>
    </script>
</body>

</html>