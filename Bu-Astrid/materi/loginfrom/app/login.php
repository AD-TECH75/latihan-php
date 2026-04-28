<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL);
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if (!$username || !$password) {
    header('Location: ' . BASE_URL);
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT id, password FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user   = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if ($user && password_verify($password, $user['password'])) {
    header('Location: ' . BASE_URL . 'views/pages/data.php');
} else {
    header('Location: ' . BASE_URL);
}

exit();
