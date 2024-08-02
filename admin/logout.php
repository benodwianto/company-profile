<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['status'])) {
    unset($_SESSION['admin_id']);
    unset($_SESSION['status']);
    header("Location: login.php");
    exit();
}

session_destroy();
