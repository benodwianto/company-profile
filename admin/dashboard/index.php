<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
    <link rel="stylesheet" href="../../assets/css/style_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="sidebar">
        <ul>
            <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa fa-info-circle"></i> Tentang</a></li>
            <li><a href="#"><i class="fa fa-box"></i> Produk</a></li>
            <li><a href="#"><i class="fa fa-concierge-bell"></i> Layanan</a></li>
            <li><a href="#"><i class="fa fa-file-alt"></i> Legalitas</a></li>
            <li><a href="#"><i class="fa fa-envelope"></i> Kontak</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            <button class="logout"><i class="fa fa-sign-out-alt"></i> Logout</button>
            <div class="admin"><i class="fa fa-user"></i> Admin 1</div>
        </div>
        <div class="main-content">
            <h2>Tambah Admin</h2>
            <form>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit"><i class="fa fa-plus"></i> Tambah Admin</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>usernameadmin1</td>
                        <td><button class="delete"><i class="fa fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>usernameadmin2</td>
                        <td><button class="delete"><i class="fa fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>usernameadmin3</td>
                        <td><button class="delete"><i class="fa fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>usernameadmin4</td>
                        <td><button class="delete"><i class="fa fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>