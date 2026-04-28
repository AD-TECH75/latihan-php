<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['hitung'])) {
    header('Location: index.php');
    exit();
}

$n1 = $_POST['number1'] ?? 0;
$n2 = $_POST['number2'] ?? 0;
$op = $_POST['operator'] ?? '';

$allowed_operators = ['plus', 'minus', 'multiplied', 'devide'];
if (
    !is_numeric($n1) ||
    !is_numeric($n2) ||
    !in_array($op, $allowed_operators)
) {
    die('Input tidak valid.');
}

$resultnumber = 0;

switch ($op) {
    case 'plus':
        $resultnumber = $n1 + $n2;
        break;
    case 'minus':
        $resultnumber = $n1 - $n2;
        break;
    case 'multiplied':
        $resultnumber = $n1 * $n2;
        break;
    case 'devide':
        $resultnumber = $n2 == 0 ? 'Tidak bisa membagi dengan nol' : $n1 / $n2;
        break;
}

include 'result.php';
