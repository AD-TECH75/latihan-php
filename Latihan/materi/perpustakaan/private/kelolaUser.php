<?php
session_start();
include '../config/connection.php';
include '../views/bootstrap.php';

// Pastikan user sudah login
if (!isset($_SESSION["username"])) {
    header("Location: " . BASEURL . "auth/login.php");
    exit();
}

// Ambil user yang sedang login
$currentUsername = $_SESSION["username"];
$qUser = mysqli_query($conn, "SELECT * FROM user WHERE username='$currentUsername'");
$currentUser = mysqli_fetch_assoc($qUser);

// Simpan ID user login
$currentUserId = $currentUser["id"];
$_SESSION["id"] = $currentUserId;
$_SESSION["role"] = $currentUser["role"];
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
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

                    while ($row = mysqli_fetch_assoc($result)):
                        $isCurrentUser = ($row["id"] == $currentUserId);
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['username'] ?></td>

                            <td>
                                <?php if ($isCurrentUser): ?>
                                    <span class="badge bg-info text-dark"><?= $row['role'] ?></span>

                                <?php else: ?>
                                    <form action="<?= BASEURL ?>app/process.php" method="post"
                                        class="d-flex justify-content-center">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                        <select name="role" class="form-select form-select-sm w-auto"
                                            onchange="this.form.submit()">
                                            <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>admin</option>
                                            <option value="pengarang" <?= $row['role'] == 'pengarang' ? 'selected' : '' ?>>
                                                pengarang</option>
                                            <option value="user" <?= $row['role'] == 'user' ? 'selected' : '' ?>>user</option>
                                        </select>
                                    </form>
                                <?php endif; ?>
                            </td>

                            <td><?= $row['status'] ?></td>

                            <td style="width: 200px;">
                                <?php if ($isCurrentUser): ?>
                                    <span class="badge bg-primary p-2">Your Account</span>

                                <?php else: ?>
                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- Ban / Unban -->
                                        <form action="<?= BASEURL ?>app/process.php" method="post">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="hidden" name="status"
                                                value="<?= $row['status'] == 'active' ? 'ban' : 'active' ?>">

                                            <button type="submit" name="ban"
                                                class="btn <?= $row['status'] == 'active' ? 'btn-danger' : 'btn-success' ?> btn-sm">
                                                <?= $row['status'] == 'active' ? '<i class="bi bi-ban"></i>' : '<i class="bi bi-circle"></i>' ?>
                                            </button>
                                        </form>

                                        <!-- Delete -->
                                        <form action="<?= BASEURL ?>app/process.php" method="post">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <button type="submit" name="delete" class="btn btn-secondary btn-sm">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>

                                    </div>
                                <?php endif; ?>
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