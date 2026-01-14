<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $nomor    = $_POST['nomor'] ?? '';

    if (($username) !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && ctype_digit($nomor)) {
        $data = [
            'username' => $username,
            'email' => $email,
            'nomor' => (string)$nomor
        ];
    } else {
        header('location: ./index.php');
        exit();
    }
} else {
    header('location: ./index.php');
    exit();
}

if (!isset($data)) {
    header('Location: index.php');
    exit;
}

require __DIR__ . '/views/layout/header.php';
require __DIR__ . '/views/pages/home.php';
require __DIR__ . '/views/layout/footer.php';
