<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'db_crud';

$koneksi = mysqli_connect($host, $username, $password, $db_name);

if (!$koneksi) {
    die("koneksi gagal" . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8');

// membuat base url untuk memudahkan pengelolaan link
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$baseurl = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
define('BASE_URL', $protocol . '://' . $host . $baseurl);
