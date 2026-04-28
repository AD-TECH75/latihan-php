<?php
$servername = 'localhost';
$username = 'akaza';
$password = 'admin123';
$dbname = 'db_login';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die('connection failed: ' . mysqli_connect_error());
}