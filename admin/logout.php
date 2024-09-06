<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['status'])) {
    // Bersihkan sesi terkait login attempts
    unset($_SESSION['login_attempts']);
    unset($_SESSION['remaining_time']);

    unset($_SESSION['admin_id']);
    unset($_SESSION['status']);
    header("Location: ../index.php");
    exit();
}

session_destroy();
?>