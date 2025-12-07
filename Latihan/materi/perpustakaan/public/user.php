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
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('location: ' . BASEURL . 'index.php?error=invalid_role');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/style/template.css">
</head>

<body>
    <header><?php include BASEPATH . '/views/template/header.php' ?></header>

    <main class="container">
        <!-- =============== BAGIAN DAFTAR BUKU =============== -->
        <div class="table-buku" style="margin-top: 20px;">
            <h2 class="text text-capitalize text-center">book-list</h2>

            <!-- Alert PINJAM (hanya untuk aksi pinjam) -->
            <?php if (isset($_GET['pinjam'])): ?>
                <div class="alert 
                    <?= $_GET['pinjam'] === 'success' ? 'alert-success' : 'alert-danger' ?> 
                    text-center auto-hide">
                    <?= $_GET['pinjam'] === 'success'
                        ? 'Peminjaman berhasil!'
                        : 'Gagal meminjam buku.' ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-striped text-center">
                <thead class="table text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th style="width: 50px;">Hari</th>
                        <th style="width: 50px;">Jumlah</th>
                        <th style="width: 50px;">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center align-middle">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM buku WHERE visibility = 'show'");
                    $no = 1;
                    while ($row = mysqli_fetch_array($result)):
                        ?>
                        <tr>
                            <form action="<?= BASEURL ?>app/pinjam.php" method="post" style="margin:0; padding:0;">
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['judul']) ?></td>
                                <td><?= htmlspecialchars($row['penulis']) ?></td>
                                <td><?= $row['tahun'] ?></td>
                                <td><?= $row['stok'] ?></td>
                                <td><input type="number" name="day" style="width:50px;" min="1" max="183" required></td>
                                <td><input type="number" name="jumlah" style="width:50px;" min="1" required></td>
                                <td>
                                    <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                                    <button type="submit" name="submit" class="btn btn-sm btn-primary">Pinjam</button>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- =============== BAGIAN LIST PEMINJAMAN =============== -->
        <?php
        $idUser = (int) ($_SESSION['id'] ?? 0);
        $resultPinjam = null;

        if ($idUser > 0) {
            $query = "SELECT p.id AS pinjam_id,b.judul,p.tgl_pinjam,p.tgl_kembali,p.jumlah FROM peminjaman p INNER JOIN buku b ON p.buku_id = b.id WHERE p.user_id = ? AND p.status = 'dipinjam' ORDER BY p.tgl_pinjam ASC";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $idUser);
            mysqli_stmt_execute($stmt);
            $resultPinjam = mysqli_stmt_get_result($stmt);
        }
        ?>

        <?php if ($resultPinjam && mysqli_num_rows($resultPinjam) > 0): ?>
            <div class="table-pinjam" style="margin-top: 50px;">
                <h2 class="text text-capitalize text-center">list-peminjaman</h2>

                <!-- Alert KEMBALIKAN (hanya untuk aksi kembali) -->
                <?php if (isset($_GET['kembali'])): ?>
                    <div class="alert 
                        <?= $_GET['kembali'] === 'success' ? 'alert-success' : 'alert-danger' ?> 
                        text-center auto-hide">
                        <?= $_GET['kembali'] === 'success'
                            ? 'Buku berhasil dikembalikan!'
                            : 'Gagal mengembalikan buku.' ?>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Sisa Hari</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th style="width: 70px">Kembali</th>
                            <th style="width: 80px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($resultPinjam)):
                            $tglKembali = new DateTime($row['tgl_kembali']);
                            $sekarang = new DateTime();

                            // menghitung selisih hari
                            $interval = $sekarang->diff($tglKembali);
                            $sisaHari = (int) $interval->format('%r%a') + 1;

                            // Tentukan status & warna
                            if ($sisaHari < 0) {
                                $statusTampil = 'terlambat';
                                $statusWarna = 'badge bg-danger';
                                $sisaWarna = 'text-danger fw-bold';
                            } elseif ($sisaHari == 0) {
                                $statusTampil = 'kembalikan';
                                $statusWarna = 'badge bg-warning text-dark';
                                $sisaWarna = 'text-warning fw-bold';
                            } else {
                                $statusTampil = 'dipinjam';
                                $statusWarna = 'badge bg-success';
                                $sisaWarna = 'text-success';
                            }
                            ?>
                            <tr>
                                <form action="<?= BASEURL ?>app/kembali.php" method="post" style="display:inline;">
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['judul']) ?></td>
                                    <td><?= $row['tgl_pinjam'] ?></td>
                                    <td><?= $row['tgl_kembali'] ?></td>
                                    <td class="<?= $sisaWarna ?>"><?= $sisaHari ?></td>
                                    <td><span class="<?= $statusWarna ?>"><?= $statusTampil ?></span></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td>
                                        <?php if ($row['jumlah'] == 1): ?>
                                            <input type="number" name="jumlahkembali" id="jumlahkembali" value="1" style="width: 70px;" readonly>
                                        <?php else : ?>
                                            <input type="number" name="jumlahkembali" id="jumlahkembali" min="1" max="<?= $row['jumlah'] ?>" style="width: 70px;" required>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="pinjam_id" value="<?= $row['pinjam_id'] ?>">
                                        <button type="submit" name="submit" class="btn btn-sm btn-primary">kembalikan</button>
                                    </td>
                                </form>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

    <footer><?php include BASEPATH . '/views/template/footer.php' ?></footer>

    <!-- JavaScript: Auto-hide alert + hapus parameter URL -->
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
        if (window.location.search.includes('pinjam') || window.location.search.includes('kembali')) {
            setTimeout(function () {
                history.replaceState(null, '', window.location.pathname);
            }, 5500);
        }
    </script>
</body>

</html>