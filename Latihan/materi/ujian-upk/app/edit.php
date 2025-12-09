<?php include '../config/connection.php' ?>
<?php
$id = $_POST['id'] ?? null;

$query = "SELECT * FROM buku WHERE id=?";
$result = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($result, "i", $id);
mysqli_stmt_execute($result);
$result = mysqli_stmt_get_result($result);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $id = $_POST['id'] ?? null;
    $judul = trim($_POST["judul"]);
    $pengarang = trim($_POST["pengarang"]);
    $tahun = (int) $_POST["tahun"];

    mysqli_autocommit($conn, false);

    $query = "UPDATE buku SET judul=?, pengarang=?, tahun=? WHERE id=?";
    $result = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($result, "ssii", $judul, $pengarang, $tahun, $id);
    $check = mysqli_stmt_execute($result);

    if ($check) {
        mysqli_commit($conn);
        header("location: " . BASEURL . "private/dashboard.php?success=edit");
    } else {
        mysqli_rollback($conn);
        header("location: " . BASEURL . "private/dashboard.php?error=edit");
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

    <main class="d-flex justify-content-center align-items-center vh-100 animate__animated animate__fadeInUp">
        <div class="card card-body shadow p-4 col-10 col-sm-8 col-md-8 col-lg-4">

            <h1 class="fw-bold text-center text-capitalize">edit buku</h1>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="mb-3">
                    <label for="judul" class="form-label text-capitalize">judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="<?= $row['judul'] ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="pengarang" class="form-label text-capitalize">pengarang</label>
                    <input type="text" name="pengarang" id="pengarang" class="form-control"
                        value="<?= $row['pengarang'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tahun" class="form-label text-capitalize">tahun</label>
                    <input type="number" name="tahun" min="1000" max="<?= date('Y') ?>" class="form-control"
                        value="<?= $row['tahun'] ?>" required>
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