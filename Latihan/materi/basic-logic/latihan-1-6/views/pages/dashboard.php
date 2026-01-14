<?php
session_start();
require_once __DIR__ . './login.php';

if (isset($_SESSION['username']) && isset($_SERVER['password'])) {
    require __DIR__ . '../layout/header.php';
    require __DIR__ . '../layout/footer.php';
}
