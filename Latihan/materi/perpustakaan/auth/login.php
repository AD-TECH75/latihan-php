<?php include '../config/connection.php' ?>
<?php
session_start();
function select_role($row)
{
    if ($row["role"] == "admin") {
        header("location:" . BASEURL . "private/admin.php");
        exit();
    } else if ($row["role"] == "pengarang") {
        header("location:" . BASEURL . "public/pengarang.php");
        exit();
    } else {
        header("location:" . BASEURL . "public/user.php");
        exit();
    }
}

//mengambil error sekali saja
$error = "";
if (isset($_SESSION["login_error"])) {
    $error = $_SESSION["login_error"];
    unset($_SESSION["login_error"]);
}

// 1. login dari cookie
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // cek status ban
        if ($row["status"] == "ban") {
            setcookie("username", "", time() - 3600, '/');
            setcookie("password", "", time() - 3600, '/');

            $_SESSION['login_error'] = "Anda telah diban oleh admin silahkan hubungi admin";
            header("location: " . BASEURL . "auth/login.php");
            exit();
        }

        // ⬅ MENAMBAHKAN SESSION ID
        $_SESSION["id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["role"];

        select_role($row);
    }
}

// 2. proses login
if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $remember = isset($_POST['save']) ? 1 : 0;

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row["status"] == "ban") {
            $_SESSION["login_error"] = "Akun anda telah diban oleh admin silahkan hubungi admin";
            header("location: " . BASEURL . "auth/login.php");
            exit();
        }

        // ⬅ MENAMBAHKAN SESSION ID
        $_SESSION["id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["role"];

        if ($remember) {
            setcookie("username", $row["username"], time() + (86400 * 7), "/");
            setcookie("password", $row["password"], time() + (86400 * 7), "/");
        }

        select_role($row);
    } else {
        $_SESSION["login_error"] = "Username atau password salah";
        header("Location: login.php");
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
    <link rel="stylesheet" href="../assets/style/login.css" />
    <?php include '../views/bootstrap.php' ?>
</head>

<body>
    <main class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card card-body p-4 shadow col-10 col-sm-8 col-md-8 col-lg-4" style="width: 100%; max-width: 500px;">
            <h1 style="text-align: center;">LOGIN</h1>
            <form action="#" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username"
                        class="form-control <?= ($error ? 'is-invalid' : '') ?>" placeholder="username"
                        value="<?= isset($_POST['$username']) ? $_POST["username"] : '' ?>" required />
                    <?php if ($error): ?>
                        <div class="invalid-feedback">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control <?= ($error ? 'is-invalid' : '') ?>" placeholder="password" required />
                    <div class="form-text text-end">
                        <a href="newPassword.php">Forgot Password?</a>
                    </div>
                </div>

                <div class="mb3 form-check">
                    <input type="checkbox" name="save" id="save" class="form-check-input" />
                    <label for="save" class="form-check-label">Remember me</label>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <input type="submit" value="submit" class="btn btn-primary" name="submit">
                </div>

                <div class="mt-4" style="text-align: center;">
                    <p>Don't have an account? <a href="register.php">register</a></p>
                </div>
            </form>
        </div>
    </main>
</body>

</html>