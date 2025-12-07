<?php
include '../config/connection.php';
$id = $_POST["id"];

// memastikan bahwa sudah login
if (!isset($_SESSION['username'])) {
    header('location: ' . BASEURL . 'index.php?error=not_logged_in');
    exit();
}

// memastikan role nya benar 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pengarang') {
    header('location: ' . BASEURL . 'index.php?error=invalid_role');
    exit();
}

mysqli_autocommit($conn, false);

// proses hapus
$query = "DELETE FROM buku WHERE id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
$ok1 = mysqli_stmt_execute($stmt);

if ($ok1) {
    // jika berhasil
    mysqli_commit($conn);
    header("location: " . BASEURL . "public/pengarang.php?success=berhasil_hapus");
} else {
    // jika gagal
    mysqli_rollback($conn);
    header("location: " . BASEURL . "public/pengarang.php?error=gagal_hapus");
}

mysqli_close($conn);
exit();
?>