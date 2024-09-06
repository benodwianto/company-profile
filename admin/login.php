<?php
session_start();
include '../config/functions.php';

// Fungsi untuk membatasi percobaan login
function limitLoginAttempts($username) {
    $maxAttempts = 5;
    $blockTime = 600; // 10 menit

    if (!isset($_SESSION['login_attempts'][$username])) {
        $_SESSION['login_attempts'][$username] = [
            'attempts' => 0,
            'last_attempt_time' => null,
            'block_until' => null,
        ];
    }

    $attemptData = $_SESSION['login_attempts'][$username];
    $currentTime = time();

    // Cek apakah akun sedang diblokir
    if ($attemptData['block_until'] && $currentTime < $attemptData['block_until']) {
        $remainingTime = $attemptData['block_until'] - $currentTime;
        $_SESSION['remaining_time'] = $remainingTime;
        $_SESSION['message'] = "Terlalu banyak percobaan login gagal. Coba lagi setelah " . ceil($remainingTime / 60) . " menit.";
        $_SESSION['message_type'] = 'error';
        header("Location: login.php");
        exit();
    }

    // Reset percobaan jika waktu blokir sudah habis
    if ($attemptData['last_attempt_time'] && ($currentTime - $attemptData['last_attempt_time']) > $blockTime) {
        $_SESSION['login_attempts'][$username] = [
            'attempts' => 0,
            'last_attempt_time' => null,
            'block_until' => null,
        ];
    }

    $_SESSION['login_attempts'][$username]['attempts']++;
    $_SESSION['login_attempts'][$username]['last_attempt_time'] = $currentTime;

    // Blokir akun jika melebihi batas percobaan
    if ($_SESSION['login_attempts'][$username]['attempts'] >= $maxAttempts) {
        $_SESSION['login_attempts'][$username]['block_until'] = $currentTime + $blockTime;
        $remainingTime = $_SESSION['login_attempts'][$username]['block_until'] - $currentTime;
        $_SESSION['remaining_time'] = $remainingTime;
        $_SESSION['message'] = "Akun Anda diblokir selama " . ceil($remainingTime / 60) . " menit.";
        $_SESSION['message_type'] = 'error';
        header("Location: login.php");
        exit();
    }
}

// Jika user sudah login, redirect ke dashboard
if (isset($_SESSION['admin_id']) && isset($_SESSION['status'])) {
    header("Location: dashboard");
    exit();
}

// Hasilkan token CSRF baru jika tidak ada
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifikasi token CSRF
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $_SESSION['message'] = "Invalid CSRF token";
        $_SESSION['message_type'] = 'error';
        header("Location: login.php");
        exit();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Batasi percobaan login
    limitLoginAttempts($username);

    $admin = login($username, $password);

    if ($admin) {
        // Regenerasi session ID untuk keamanan
        session_regenerate_id(true);

        // Reset percobaan login setelah berhasil login
        $_SESSION['login_attempts'][$username] = [
            'attempts' => 0,
            'last_attempt_time' => null,
            'block_until' => null,
        ];

        // Buat sesi login
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['status'] = $admin['status'];

        // Redirect ke dashboard
        $_SESSION['message'] = "Berhasil login.";
        $_SESSION['message_type'] = 'success';
        header("Location: dashboard");
        exit();
    } else {
        // Jika login gagal
        $_SESSION['message'] = 'Username atau password salah. Sisa percobaan: ' . (5 - $_SESSION['login_attempts'][$username]['attempts']);
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #951C11, #9d2a20);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .login-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        padding: 40px;
        max-width: 400px;
        width: 100%;
    }

    .countdown-message {
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        color: #ff4e4e;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="text-center">Login</h2>

        <!-- Countdown Message -->
        <?php if (isset($_SESSION['remaining_time']) && $_SESSION['remaining_time'] > 0) : ?>
        <div class="countdown-message" id="countdown-message">
            Akun Anda diblokir. Coba lagi dalam <span id="countdown"></span> detik.
        </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="login.php" method="post" id="login-form"
            <?php if (isset($_SESSION['remaining_time']) && $_SESSION['remaining_time'] > 0) echo 'style="display:none;"'; ?>>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-danger btn-login">Login</button>
        </form>
    </div>

    <!-- JS: jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert -->
    <script>
    <?php if (isset($_SESSION['message']) && isset($_SESSION['message_type'])): ?>
    Swal.fire({
        icon: '<?php echo $_SESSION['message_type']; ?>',
        title: '<?php echo $_SESSION['message']; ?>',
        showConfirmButton: true
    });
    <?php unset($_SESSION['message'], $_SESSION['message_type']); endif; ?>
    </script>

    <!-- Countdown Logic -->
    <script>
    <?php if (isset($_SESSION['remaining_time']) && $_SESSION['remaining_time'] > 0) : ?>
    let remainingTime = <?php echo $_SESSION['remaining_time']; ?>;
    const countdownElement = document.getElementById('countdown');
    const form = document.getElementById('login-form');
    const countdownMessage = document.getElementById('countdown-message');

    function updateCountdown() {
        if (remainingTime > 0) {
            countdownElement.textContent = remainingTime;
            remainingTime--;

            $.ajax({
                url: 'update_remaining_time.php',
                method: 'POST',
                data: {
                    remaining_time: remainingTime
                }
            });

        } else {
            countdownMessage.style.display = 'none';
            form.style.display = 'block';
        }
    }

    setInterval(updateCountdown, 1000);
    <?php endif; ?>
    </script>
</body>

</html>