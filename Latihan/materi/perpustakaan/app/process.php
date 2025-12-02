<?php 
include '../config/connection.php';
session_start();

$id = $_POST["id"];
$role = $_POST["role"];
$status = $_POST['status'];

if (isset($_POST['role'])) {
    if ($id == $_SESSION['role']) {
        header('location: '.BASEURL.'private/kelolauser.php');
        exit();
    }

    $query = "UPDATE user SET role='$role' WHERE id='$id'";
    mysqli_query($conn, $query);
}

if (isset($_POST['ban'])) {
    $query = "UPDATE user SET status='$status' WHERE id='$id'";
    mysqli_query($conn, $query);
}

if (isset($_POST["delete"])) {
    $query = "DELETE FROM user WHERE id='$id'";
    mysqli_query($conn, $query);
}

// global back
header("location:". BASEURL."private/kelolaUser.php");
exit();