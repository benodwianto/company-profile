<?php
session_start();
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = login($username, $password);

    if ($admin) {
        // Jika login berhasil, buat sesi
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['status'] = $admin['status'];

        // Arahkan ke halaman dashboard atau halaman lain
        header("Location: dashboard");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>