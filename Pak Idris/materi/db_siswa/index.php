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
    <div class="container">
        <h2 class="mb-4">Data Siswa</h2>
        <a href="tambah.php" class="btn btn-success mb-3">Tambah Data</a>

        <table class="table table-bordered table-striped">
            <thead class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                </tr>
            </thead>

            <tbody class="table table-light">
                <?php
                $result = mysqli_query($koneksi, 'SELECT * FROM siswa');
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td> <?= htmlspecialchars($row['id']) ?></td>
                        <td> <?= htmlspecialchars($row['nama']) ?></td>
                        <td> <?= htmlspecialchars($row['kelas']) ?></td>
                        <td> <?= htmlspecialchars($row['alamat']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <?php ?>
        </table>
    </div>
</body>

</html>