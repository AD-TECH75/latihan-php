<?php include '../config/connection.php' ?>
<?php
session_start();

// penghapusan error jika di refresh
$error_user = '';
$error_pass = '';

// pemberitahuan error
if (isset($_SESSION['np_error_user'])) {
    $error_user = $_SESSION['np_error_user'];
    unset($_SESSION['np_error_user']);
}

if (isset($_SESSION['np_error_pass'])) {
    $error_pass = $_SESSION['np_error_pass'];
    unset($_SESSION['np_error_pass']);
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $newpass = $_POST['newPassword'];
    $confirmPass = $_POST['confirmPassword'];

    // cek username
    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        $_SESSION["np_error_user"] = "username tidak ditemukan";
        header("location: newPassword.php");
        exit();
    }

    if ($newpass != $confirmPass) {
        $_SESSION["np_error_pass"] = "password tidak sama";
        header("location: newPassword.php");
        exit();
    }

    $update = "UPDATE user SET password='$newpass' WHERE username='$username'";
    mysqli_query($conn, $update);

    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../views/bootstrap.php' ?>
</head>

<body>
    <main class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card card-body p-3 shadow col-10 col-sm-8 col-md-8 col-lg-4" style="width: 100%; max-width: 500px;">
            <h1 class="text-center mb-3">Reset Password</h1>
            <form action="#" method="post">
                <div class="mb-1">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control <?= ($error_user ? 'is-invalid' : '') ?>" name="username"
                        id="username" placeholder="username"
                        value="<?= isset($_POST['$username']) ? $_POST["username"] : '' ?>" required>
                    <?php if ($error_user): ?>
                        <div class="invalid-feedback">
                            <?= $error_user ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-1">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" name="newPassword" id="newPassword"
                        class="form-control <?= ($error_pass ? 'is-invalid' : '') ?>" placeholder="New Password"
                        required>
                    <?php if ($error_pass): ?>
                        <div class="invalid-feedback">
                            <?= $error_pass ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-1">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword"
                        class="form-control <?= ($error_pass ? 'is-invalid' : '') ?>" placeholder="Confirm Password"
                        required>
                    <?php if ($error_pass): ?>
                        <div class="invalid-feedback">
                            <?= $error_pass ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-grid gap-2 mt1">
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                </div>

                <div class="text text-center mt-2">
                    <p>do you remember the password? <a href="login.php">Back</a></p>
                </div>
            </form>
        </div>
    </main>
</body>

</html>