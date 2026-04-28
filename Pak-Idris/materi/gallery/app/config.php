<?php
// Contoh config.php yang benar
$host = 'localhost';
$user = 'akaza';
$pass = 'persebaya1927'; // sesuaikan password
$db   = 'db_gallery';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}