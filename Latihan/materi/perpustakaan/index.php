<?php include 'config/connection.php' ?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My-Library</title>
    <?php include 'views/bootstrap.php' ?>
    <link rel="stylesheet" href="assets/style/tamplate.css">
</head>

<body>
    <header><?php include "views/template/header.php" ?></header>
    <main class="container mt-2">
        <h1 class="text text-center text-capitalize">list-book</h1>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped tbody-scrollable">
                <thead class="table">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <tbody class="table">
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
    const html = document.getElementById("htmlpage");
    const checkbox = document.getElementById("checkbox");
    checkbox.addEventListener("change", () => {
        if (checkbox.checked) {
            html.setAttribute("data-bs-theme", "dark");
        } else {
            html.setAttribute("data-bs-theme", "light");
        }
    })
</script>

</html>