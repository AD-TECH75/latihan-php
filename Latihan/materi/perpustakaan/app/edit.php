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

$id = $_POST['id'];

$query = "SELECT * FROM buku WHERE id=?";
$result = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($result, "i", $id);
mysqli_stmt_execute($result);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($result));

if (isset($_POST["submit"])) {
    $id = (int) $_POST["id"];
    $judul = trim($_POST["judul"]);
    $tahun = (int) $_POST["tahun"];
    $stock = (int) $_POST["stok"];

    mysqli_autocommit($conn, false);
    $queryupdate = "UPDATE buku SET judul=?, tahun=?, stok=? WHERE id=?";
    $resultupdate = mysqli_prepare($conn, $queryupdate);
    mysqli_stmt_bind_param($resultupdate, "siii", $judul, $tahun, $stock, $id);
    $ok1 = mysqli_stmt_execute($resultupdate);

    if ($ok1) {
        mysqli_commit($conn);
        header("location: " . BASEURL . "public/pengarang.php?success=berhasil_edit");
    } else {
        mysqli_rollback($conn);
        header("location: " . BASEURL . "public/pengarang.php?error=gagal_edit");
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
            <h1 style="text-align: center;">Edit buku</h1>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="judul"
                        value="<?= $row['judul'] ?>" required />
                </div>

                <div class="mb-1">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" id="tahun" maxlength="4" minlength="4" class="form-control"
                        placeholder="tahun" value="<?= $row['tahun'] ?>" required />
                </div>

                <div class="mb-1">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" placeholder="stok"
                        value="<?= $row['stok'] ?>" required />
                </div>

                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </main>

    <footer><?php include BASEPATH . '/views/template/footer.php' ?></footer>
</body>

</html>