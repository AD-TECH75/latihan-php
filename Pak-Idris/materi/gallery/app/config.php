<?php
$host = 'localhost';
$username = 'akaza';
$pass = 'persebaya1927';
$dbname = 'db_gallery';

$conn = new mysqli($host, $username, $pass, $dbname);

if ($conn -> connect_error) {
    die("connection failed: " . $conn->connect_error);
}