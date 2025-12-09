<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db_perpustakaan';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die('Cannot connect to database'. mysqli_connect_error());
}

// membuat base url
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];

$path = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
$projectFolder = $path[0]; // folder utama

//! define BASEURL
define("BASEURL", $protocol . $host . "/" . $projectFolder . "/");

//! define BASEPATH
define("BASEPATH", dirname(__DIR__) . "/");
