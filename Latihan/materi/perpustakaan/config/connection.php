<?php
// menambahkan database
$host = "localhost";
$username = "root";
$password = "";
$dbName = "perpustakaan_db";

$conn = mysqli_connect($host, $username, $password, $dbName);

if (!$conn) {
    die("koneksi gagal" . mysqli_connect_error());
}

// BASEPATH → path absolut ke folder project
define('BASEPATH', str_replace('\\', '/', realpath(dirname(__DIR__))));


// mengambil protokol http atau https
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    ? "https://" 
    : "http://";

// host (localhost atau domain)
$host = $_SERVER['HTTP_HOST'];

// full path ke folder project
$projectPath = str_replace('\\', '/', dirname(__DIR__)); // C:/xampp/../perpustakaan
$docRoot     = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])); 

// mendapatkan nama folder relatif terhadap htdocs
$relativePath = str_replace($docRoot, '', $projectPath);
$relativePath = trim($relativePath, '/') . '/';

// define BASEURL
define('BASEURL', $protocol . $host . '/' . $relativePath);

?>