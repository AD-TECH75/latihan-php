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
        <table class="table table-bordered table-striped text-center">
            <thead class="table text-center">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Hari</th>
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
                            <td><input type="number" name="day" id="day" style="width: 50px;"></td>
                            <td class="text-center align-middle" style="width: 50px;">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="judul" value="<?= $row['judul'] ?>">
                                <button type="submit" name="submit" class="btn btn-primary">Pinjam</button>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
    <footer><?php include BASEPATH . '/views/template/footer.php' ?></footer>
</body>



</html>