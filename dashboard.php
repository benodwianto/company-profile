<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body>
    <?php include 'aside.php'; ?>
    <article class="contracted">
        <?php include 'nav.php';?>
        <div class="container mt-5">
            <!-- Content Div -->
            <div class="content">
                <!-- Form Input -->
                <h2>Form Input</h2>
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan password">
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>

                <!-- Tabel -->
                <div class="mt-5">
                    <h2>Daftar Pengguna</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>user1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>user2</td>
                            </tr>
                            <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </article>
    <script>
    document.getElementById('toggle-aside').addEventListener('click', function() {
        const aside = document.querySelector('aside');
        const article = document.querySelector('article');
        const toggleIcon = document.getElementById('toggle-aside');
        aside.classList.toggle('hidden');
        if (aside.classList.contains('hidden')) {
            article.classList.add('expanded');
            article.classList.remove('contracted');
            toggleIcon.classList.remove('bi-x');
            toggleIcon.classList.add('bi-list');
        } else {
            article.classList.add('contracted');
            article.classList.remove('expanded');
            toggleIcon.classList.remove('bi-list');
            toggleIcon.classList.add('bi-x');
        }
    });
    </script>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>