<?php include '../config/connection.php' ?>
<?php
if (isset($_POST['submit'])) {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $tahun = (int) $_POST['tahun'];

    mysqli_autocommit($conn, false);

    $query = "INSERT INTO buku (judul, pengarang, tahun) VALUES (?, ?, ?)";
    $result = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($result, "ssi", $judul, $pengarang, $tahun);
    $check = mysqli_stmt_execute($result);

    if ($check) {
        mysqli_commit($conn);
        header("location: " . BASEURL . "private/dashboard.php?success=tambah");
    } else {
        mysqli_rollback($conn);
        header("location: " . BASEURL . "private/dashboard.php?error=tambah");
    }
    mysqli_close($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= BASEURL ?>assets/css/template.css">

    <!-- bootstrap -->
    <?php include BASEPATH . 'views/bootstrap.php' ?>
</head>

<body class="bg-primary">
    <header><?php include BASEPATH . 'views/template/header.php' ?></header>

    <main>
        <main class="d-flex justify-content-center align-items-center vh-100 animate__animated animate__fadeInUp">
            <div class="card card-body shadow p-4 col-10 col-sm-8 col-md-8 col-lg-4">

                <h1 class="fw-bold text-center text-capitalize">tambah buku</h1>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="judul" class="form-label text-capitalize">judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul" required>
                    </div>

                    <div class="mb-3">
                        <label for="pengarang" class="form-label text-capitalize">pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" class="form-control" placeholder="Pengarang"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="tahun" class="form-label text-capitalize">tahun</label>
                        <input type="number" name="tahun" min="1000" max="<?= date('Y') ?>" class="form-control"
                            placeholder="Tahun" required>
                    </div>

                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" name="submit" class="btn btn-primary">submit</button>
                    </div>
                </form>
            </div>
            </div>
        </main>
</body>

</html>