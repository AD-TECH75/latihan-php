<?php
require_once "../includes/koneksi.php";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $check = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $msg = "Username sudah digunakan.";
    } else {
        $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', 'user')";
        if (mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit;
        } else {
            $msg = "Gagal mendaftar.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="../assets/style/login.css">
</head>
<body>
<div class="login-container">
  <h2>Daftar Akun</h2>
  <?php if($msg): ?><p class="error"><?= $msg ?></p><?php endif; ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Daftar</button>
  </form>
  <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
