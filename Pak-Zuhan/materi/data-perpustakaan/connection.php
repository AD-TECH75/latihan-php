<?php
    $host     = "localhost";
    $username = "root";
    $password = "";
    $database = "perpustakaan_db";
    
    $con = mysqli_connect($host, $username, $password, $database);

    if (!$con) {
        die("Tidak dapat terhubung dengan database!!". mysqli_connect_error());
    }
?>
