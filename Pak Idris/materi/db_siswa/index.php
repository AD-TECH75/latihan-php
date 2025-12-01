<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>DB_SISWA</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB' crossorigin='anonymous'>
</head>

<body class="p-4">
    <main class="container">
        <h2 class="mb-4">Data Siswa</h2>
        <a href="tambah.php" class="btn btn-success mb-3">Tambah Data</a>

        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM siswa");
                $no = 1;
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row["nama"] ?></td>
                        <td><?= $row["kelas"] ?></td>
                        <td><?= $row["alamat"] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </main>
</body>

</html>