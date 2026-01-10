<?php include 'config/connection.php' ?>
<?php header(BASEPATH . 'auth/login.php') ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My-Library</title>
    <?php include 'views/bootstrap.php' ?>
    <link rel="stylesheet" href="assets/style/template.css">
</head>

<body>
    <header><?php include "views/template/header.php" ?></header>
    <main class="container mt-2">
        <!-- Alert: Error Umum (termasuk invalid_role) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center auto-hide text-white">
                <?php
                // Pesan error berdasarkan kode
                $message = match ($_GET['error']) {
                    'invalid_role' => 'Akses ditolak: Anda bukan pengarang.',
                    'not_logged_in' => 'Silakan login terlebih dahulu.',
                    default => 'Terjadi kesalahan. Silakan coba lagi.'
                };
                echo htmlspecialchars($message);
                ?>
            </div>
        <?php endif; ?>

        <h1 class="text text-center text-capitalize">list-book</h1>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped tbody-scrollable">
                <thead class="table text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <tbody class="text-center align-middle">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM buku WHERE visibility='show'");
                    $no = 1;
                    while ($row = mysqli_fetch_array($result)):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['judul'] ?></td>
                            <td><?= $row['penulis'] ?></td>
                            <td><?= $row['tahun'] ?></td>
                            <td><?= $row['stok'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer><?php include "views/template/footer.php" ?></footer>
</body>
<script>
    document.querySelectorAll('.auto-hide').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function () {
                alert.remove();
            }, 500);
        }, 5000); // 5 detik
    });

    // Hapus parameter URL setelah 5.5 detik agar tidak muncul saat refresh
    if (window.location.search.includes('error')) {
        setTimeout(function () {
            history.replaceState(null, '', window.location.pathname);
        }, 5500);
    }
</script>

</html>