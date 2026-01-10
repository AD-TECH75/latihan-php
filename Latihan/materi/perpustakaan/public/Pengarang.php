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

$username = $_SESSION['username'];
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

    <main class="container">
        <!-- daftar buku -->
        <div class="tabel-buku">
            <h2 class="text text-capitalize text-center" style="margin-top: 20px;">book-list</h2>
            <?php
            $query = "SELECT * FROM buku WHERE penulis=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            ?>
            <table class="table table-bordered table-striped text-center">
                <thead class="table text-center">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th style="width: 150px;">Action</th>
                </thead>

                <tbody class="text-center align-middle">
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td><?= htmlspecialchars($row['penulis']) ?></td>
                            <td><?= $row['tahun'] ?></td>
                            <td><?= $row['stok'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="<?= BASEURL ?>app/edit.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-pen"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="<?= BASEURL ?>app/hapus.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer><?php include BASEPATH . '/views/template/footer.php' ?></footer>
</body>

</html>