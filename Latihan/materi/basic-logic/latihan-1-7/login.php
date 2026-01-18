<?php
session_start();
session_regenerate_id(true);

$user = [
    'username' => 'admin',
    'password' => password_hash('admin123', PASSWORD_BCRYPT),
    'role' => 'admin'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = rtrim($_POST['username']);
    $password = rtrim($_POST['password']);
    $token_csrf = rtrim($_POST['crsf']);

    if ($user['username'] === $username && $user['password'] === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['role'] = $user['role'];

        header("location: ./dashboard.php");
        exit();
    } else {
        $_SESSION['flash'] = 'unexpected_request_method';
        header("location: ./index.php");
        exit();
    }
} else {
    $_SESSION['flash'] = 'unexpected_request_method';
    header("location: ./index.php");
    exit();
}
