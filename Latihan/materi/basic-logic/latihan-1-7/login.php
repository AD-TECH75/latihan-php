<?php

declare(strict_types=1);
session_start();
require_once __DIR__ . '/lib/csrf.php';

$user = [
    'username' => 'admin',
    'password' => password_hash('admin123', PASSWORD_BCRYPT),
    'role' => 'admin'
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash'] = 'unexpected_request_method';
    header("location: ./index.php");
    exit();
}

if (!verify_csrf($_POST['csrf'] ?? '')) {
    http_response_code(403);
    exit();
}

$username = rtrim($_POST['username']);
$password = rtrim($_POST['password']);

if ($user['username'] === $username && password_verify($password, $user['password'])) {
    session_regenerate_id(true);
    $_SESSION['auth'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $user['role'];

    header("location: ./dashboard.php");
    exit();
} else {
    $_SESSION['flash'] = 'Username atau password salah';
    header("location: ./index.php");
    exit();
}
