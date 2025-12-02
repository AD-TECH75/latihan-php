<?php
include '../config/connection.php';
session_start();

$id = $_POST["id"];
$datarole = $_SESSION["role"];
$role = $_POST["role"];
$status = $_POST['status'];
$visibility = $_POST['visibility'];

// memastikan yang mengedit adalah admin
if ($datarole == 'admin') {
    // admin.php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hideShow'])) {
        $query = "UPDATE buku SET visibility='$visibility' WHERE id='$id'";
        mysqli_query($conn, $query);

        header("location: " . BASEURL . "private/admin.php");
        exit();
    }

    // kelolaUser.php
    if (isset($_POST['role'])) {
        if ($id == $_SESSION['role']) {
            header('location: ' . BASEURL . 'private/kelolauser.php');
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

    // kembali
    header("location:" . BASEURL . "private/kelolaUser.php");
    exit();
} 
