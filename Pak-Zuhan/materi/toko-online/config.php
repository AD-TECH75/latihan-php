<?php
$host = "localhost";
$user = "akaza";
$pass = "persebaya1927";
$db   = "toko_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
