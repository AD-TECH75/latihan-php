<?php include '../config/connection.php' ?>
<?php
session_start();
//mengambil error sekali saja
$error = "";
if (isset($_SESSION["register_error"])) {
    $error = $_SESSION["register_error"];
    unset($_SESSION["register_error"]);
}


if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = 'user';

    $check = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

    if (mysqli_num_rows($check) == 0) {
        $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
        mysqli_query($conn, $query);

        header("location: login.php");
        exit();
    } else {
        $_SESSION["register_error"] = "Username telah di pakai";
        header("Location: register.php");
        exit();
    }
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
        <div class="card card-body p-4 shadow col-10 col-sm-8 col-md-8 col-lg-4" style="width: 100%; max-width: 500px;">
            <h1 style="text-align: center;">Register</h1>
            <form action="#" method="post" class="form">
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" name="username" id="username"
                        class="form-control <?= ($error ? 'is-invalid' : '') ?>" placeholder="username" required>
                    <?php if ($error): ?>
                        <div class="invalid-feedback">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="password"
                        required>
                    <div class="form-text">we don't know what your password is</div>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <input type="submit" value="submit" class="btn btn-primary" name="submit">
                </div>

                <div style="text-align: center;">
                    <p>Already have account? <a href="login.php">Log-in</a></p>
                </div>
            </form>
        </div>
    </main>
</body>

</html>