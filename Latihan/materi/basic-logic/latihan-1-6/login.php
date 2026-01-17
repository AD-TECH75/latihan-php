<?php
$dataAdmin = [
    'username' => 'admin',
    'password' => 'admin',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = rtrim($_POST['username'] ?? '');
    $password = rtrim($_POST['password'] ?? '');

    if ($username === $dataAdmin['username'] && $password === $dataAdmin['password']) {
        session_start();
        session_regenerate_id(true);

        $_SESSION['auth'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';

        
        header("location: ./dashboard.php");
        exit();
    } else {
        header("location: ./index.php");
        exit();
    }
} else {
    header("location: ./index.php");
    exit();
}
