<?php
include '../config/connection.php';
include BASEPATH . '/views/bootstrap.php';
session_start();
?>

<?php
// memastikan bahwa sudah login
if (!isset($_SESSION['username'])) {
    header('location: ' . BASEURL . 'index.php?error=not_logged_in');
    exit();
}

// memastikan role nya benar 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pengarang') {
    header('location: ' . BASEURL . 'index.php?error=invalid_role');
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $judul = trim($_POST['judul']);
    $tahun = (int) ($_POST['tahun'] ?? date('Y'));
    $stock = (int) ($_POST['stok'] ?? 0);

    mysqli_autocommit($conn, false);

    // menambahkan buku
    $query = "INSERT INTO buku (judul, penulis, tahun, stok) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssii", $judul, $username, $tahun, $stock);
    $check = mysqli_stmt_execute($stmt);

    if ($check) {
        // jika berhasil
        mysqli_commit($conn);
        header("location: " . BASEURL . "public/pengarang.php?success=berhasil_menambahkan");
    } else {
        // jika gagal
        mysqli_rollback($conn);
        header("location: " . BASEURL . "public/pengarang.php?error=gagal_menambahkan");
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/style/template.css">
</head>

<body>
    <header><?php include BASEPATH . '/views/template/header.php' ?></header>

    <main class="container d-flex align-items-center justify-content-center">
        <div class="card card-body p-4 shadow col-10 col-sm-8 col-md-8 col-lg-4" style="width: 100%; max-width: 500px;">
            <h1 style="text-align: center;">Tambah buku</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="judul" required />
                </div>

                <div class="mb-1">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" id="tahun" maxlength="4" minlength="4" class="form-control"
                        placeholder="tahun" required />
                </div>

                <div class="mb-1">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" placeholder="stok" required />
                </div>

                <div class="d-grid gap-2 mt-3">
                    <input type="submit" value="submit" class="btn btn-primary" name="submit">
                </div>
            </form>
        </div>
    </main>

    <footer><?php include BASEPATH . '/views/template/footer.php' ?></footer>
</body>

</html>