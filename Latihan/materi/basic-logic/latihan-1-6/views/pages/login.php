<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = rtrim($_POST['username'] ?? '');
    $password = rtrim($_POST['password'] ?? '');

    if ($username !== '' && $password !== '') {
        session_start();

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    } else {
        header("location: ../../index.php");
        exit();
    }
} else {
    header("location: ../../index.php");
    exit();
}
