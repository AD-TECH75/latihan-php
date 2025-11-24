<?php
$host = 'localhost';
$username = 'root';      // default XAMPP user
$password = '';          // default XAMPP has no password
$database = 'db_siswa';  // your database name

$koneksi = mysqli_connect($host, $username, $password, $database);

// Optional: Check connection
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>