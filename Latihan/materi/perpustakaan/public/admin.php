<?php
include '../config/connection.php';
include BASEPATH . '/views/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" class="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }

    .table {
        border-radius: 5px;
    }

    .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table th:nth-child(1),
    .table td:nth-child(1) {
        width: 5%;
    }

    .table th:nth-child(6),
    .table td:nth-child(6) {
        width: 10%;
    }

    [data-bs-theme="light"] {
        body {
            background-color: #d6d6d6ff;
        }
    }
</style>

<body>
    <header><?php include BASEPATH . '/views/template/header.php'; ?></header>
    <main class="container mt-2">
        <h1 class="text text-center text-capitalize">list-book</h1>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped tbody-scrollable">
                <thead class="table table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>status</th>
                    </tr>
                </thead>

                <tbody class="table table-light">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM buku");
                    $no = 1;
                    // while ($row = mysqli_fetch_array($result)):
                    while ($no <= 20):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <!-- <td><?= $row['judul'] ?></td>
                            <td><?= $row['penulis'] ?></td>
                            <td><?= $row['penerbit'] ?></td>
                            <td><?= $row['tahun'] ?></td>
                            <td><?= $row['stok'] ?></td> -->
                            <td>
                                <a
                                    href="<?= BASEURL ?> /app/toggle.php?id=<?= $row['id'] ?>&to=<?= $row['visibility'] == 'show' ? 'hide' : 'show' ?>">
                                    <?php if ($row['visibility'] == 'show'): ?>
                                        <i class="bi bi-eye"></i>
                                    <?php else: ?>
                                        <i class="bi bi-eye-slash"></i>
                                    <?php endif; ?>
                                </a>
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