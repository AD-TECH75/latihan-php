<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL);
    exit();
}

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$username || !$email || !$password) {
    header('Location: ' . BASE_URL);
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

mysqli_autocommit($conn, false);

$stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);

if (mysqli_stmt_execute($stmt)) {
    mysqli_commit($conn);
    header('Location: ' . BASE_URL . 'views/pages/data.php');
} else {
    mysqli_rollback($conn);
    header('Location: ' . BASE_URL);
}

mysqli_stmt_close($stmt);
exit();
