<?php 
include '../config/connection.php';
$id = $_GET["id"]; // Id ke berapa
$to = $_GET["to"]; // show or hide

if ($to == 'show') {
    mysqli_query($conn, "UPDATE buku SET visibility='show' WHERE username='$id'");
} else if ($to == 'hide') {
    mysqli_query($conn, "UPDATE buku SET visibility='hide' WHERE username='$id'");
}

header ("location:" . BASEURL . "/public/admin.php" );  