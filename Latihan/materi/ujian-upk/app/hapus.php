<?php
include '../config/connection.php';

mysqli_autocommit($conn, false);
$id = $_POST["id"];

$query = "DELETE FROM buku WHERE id=?";
$result = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($result, "i", $id);
$check = mysqli_stmt_execute($result);

if ($check) {
    mysqli_commit($conn);
    header("location: " . BASEURL . "private/dashboard.php?success=hapus");
} else {
    mysqli_rollback($conn);
    header("location: " . BASEURL . "private/dashboard.php?error=hapus");
}

mysqli_close($conn);
exit();