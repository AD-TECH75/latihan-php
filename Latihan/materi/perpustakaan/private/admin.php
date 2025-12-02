<?php include '../config/connection.php' ?>
<?php include BASEPATH . '/views/bootstrap.php' ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Library</title>
    <link rel="stylesheet" href="<?= BASEURL ?>/assets/style/tamplate.css">
</head>

<body>
    <header><?php include BASEPATH . '/views/template/header.php'; ?></header>
    <main class="container mt-2">
        <h1 class="text text-center text-capitalize">list-book</h1>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table text-center">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="table text-center align-middle align-content-center">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM buku");
                    $no = 1;
                    while ($row = mysqli_fetch_array($result)):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['judul'] ?></td>
                            <td><?= $row['penulis'] ?></td>
                            <td><?= $row['tahun'] ?></td>
                            <td><?= $row['stok'] ?></td>
                            <td class="text-center align-middle" style="width: 50px;">
                                <form action="<?= BASEURL ?>app/process.php" method="POST" style="margin: 0; padding: 0;">
                                    <input type="hidden" name="hideShow" value="1">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="visibility"
                                        value="<?= $row['visibility'] == 'show' ? 'hide' : 'show' ?>">

                                    <button type="submit" class="btn btn-secondary">
                                        <?php if ($row['visibility'] == 'show'): ?>
                                            <i class="bi bi-eye"></i>
                                        <?php else: ?>
                                            <i class="bi bi-eye-slash"></i>
                                        <?php endif; ?>
                                    </button>
                                </form>
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