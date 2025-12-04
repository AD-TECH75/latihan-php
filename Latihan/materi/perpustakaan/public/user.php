<?php include '../config/connection.php' ?>
<?php include BASEPATH . '/views/bootstrap.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/style/tamplate.css">
</head>

<body>
    <header><?php include BASEPATH . '/views/template/header.php' ?></header>
    <main class="container">
        <div class="table-buku">
            <h2 class="text text-capitalize text-center">book-list</h2>
            <?php if (isset($_GET['error'])): ?>
                <?php $msg = match ($_GET['error']) {
                    'out_of_stock' => 'Buku tidak tersedia.',
                    'missing_data' => 'tidak ada data yang di imputkan.',
                    'over_stock' => 'Jumlah tidak sesuai dengan Stok.',
                    'invalid_day' => 'Batas waktu hanya rentan 1-183 hari.',
                    'gagal_pinjam' => 'Data gagal di simpan.',
                    default => 'terjadi kesalahan.'
                }
                    ?>
                <div class="alert alert-danger text-center"><?= $msg ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success text-center">Pinjaman berhasil</div>
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
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="text-center align-middle align-content-center">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM buku");
                    $no = 1;
                    while ($row = mysqli_fetch_array($result)):
                        ?>
                        <tr>
                            <form action="<?= BASEURL ?>app/pinjam.php" style="margin: 0; padding: 0;" method="post">
                                <td><?= $no++ ?></td>
                                <td><?= $row['judul'] ?></td>
                                <td><?= $row['penulis'] ?></td>
                                <td><?= $row['tahun'] ?></td>
                                <td><?= $row['stok'] ?></td>
                                <td><input type="number" name="day" id="day" style="width: 50px;" required></td>
                                <td><input type="number" name="jumlah" id="jumlah" style="width: 50px;" required></td>
                                <td class="text-center align-middle" style="width: 50px;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="submit" class="btn btn-primary">Pinjam</button>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php
        $id = $_SESSION["id"];

        // mengambil/menyamakan data yang sedang login
        $query = "SELECT buku_id, tgl_pinjam, tgl_kembali FROM peminjaman WHERE user_id='$id'";
        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) >= 0):
            ?>
            <div class="table-pinjam" style="margin-top: 50px;">
                <h2 class="text text-capitalize text-center">list-peminjaman</h2>
                <table class="table table-bordered table-striped text-center">
                    <thead class="table text-center">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Sisa Hari</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-center align-middle align-content-center">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM buku");
                        $no = 1;
                        while ($row = mysqli_fetch_array($result)):
                            ?>
                            <tr>
                                <form action="<?= BASEURL ?>app/pinjam.php" style="margin: 0; padding: 0;" method="post">
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><?= $row['penulis'] ?></td>
                                    <td><?= $row['tahun'] ?></td>
                                    <td><?= $row['stok'] ?></td>
                                    <td class="text-center align-middle" style="width: 50px;">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="judul" value="<?= $row['judul'] ?>">
                                        <button type="submit" name="submit" class="btn btn-primary">kembalikan</button>
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
</body>



</html>