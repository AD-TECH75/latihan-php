<?php
if (!isset($resultnumber)) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Perhitungan</title>
</head>
<body>
    <h1>Hasil: <?= htmlspecialchars((string)$resultnumber) ?></h1>
    <hr>
    <a href="index.php">Hitung Lagi</a>
</body>
</html>