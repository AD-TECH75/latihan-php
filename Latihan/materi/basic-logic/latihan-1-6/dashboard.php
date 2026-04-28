<?php
declare(strict_types=1);
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin' || empty($_SESSION['auth']) ||$_SESSION['role'] !== 'admin') {
    header('location: ./index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>halo bang</p>
    <a href="../../logout.php">nih</a>
</body>

</html>