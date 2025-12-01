<?php include '../config/connection.php' ?>
<?php include '../views/bootstrap.php' ?>
<?php
if (isset($_POST['ban'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE user SET status='$status' WHERE id='$id'";
    mysqli_query($conn, $query);

    header("location: kelolaUser.php");
    exit();
}

if (isset($_POST["delete"])) {
    $id = $_POST["id"];

    $query = "DELETE FROM user WHERE id='$id'";
    mysqli_query($conn, $query);

    header("location: kelolaUser.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style/tamplate.css">
</head>

<body>
    <header><?php include "../views/template/header.php" ?></header>
    <main class="container mt-2">
        <h1 class="text text-center text-capitalize">list-user</h1>
        <div class="table table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="table table-light text-center align-middle">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM user");
                    $no = 1;
                    while ($row = mysqli_fetch_array($result)):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['role'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td class="text-center align-middle" style="width: 200px;">
                                <div class="d-flex justify-content-center gap-2">

                                    <form action="#" method="post">
                                        <input type="hidden" name="hideshow" value="1">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="status"
                                            value="<?= $row['status'] == 'active' ? 'ban' : 'active' ?>">

                                        <button type="submit" name="ban"
                                            class="btn <?= $row['status'] == 'active' ? 'btn-danger' : 'btn-success' ?> btn-sm">
                                            <?php if ($row['status'] == 'active'): ?>
                                                <i class="bi bi-ban"></i>
                                            <?php else: ?>
                                                <i class="bi bi-circle"></i>
                                            <?php endif; ?>
                                        </button>
                                    </form>

                                    <form action="#" method="post">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="delete" class="btn btn-secondary btn-sm"><i
                                                class="bi bi-trash3-fill"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer><?php include "../views/template/footer.php" ?></footer>
</body>

</html>