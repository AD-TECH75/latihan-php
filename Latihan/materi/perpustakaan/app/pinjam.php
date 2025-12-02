<?php
include '../config/connection.php';

session_start();

$id = $_POST['id'];
$day = $_POST['day'];
$judul = $_POST['judul'];

$username = $_SESSION['username'];

if (isset($_POST['submit']) && isset($_POST['day'])) {
    // memastikan tidak lebih dari 6 bulan
    if ($day > 183) {
        echo "<script>alert('Tidak boleh pinjam lebih dari 6 Bulan');</script>";

        header("location: " . BASEURL . "public/user.php");
        exit();
    }

    $pinjam = date('Y-m-d');
    $kembali = date('Y-m-d', strtotime("+$day days"));

    $querypinjam = "INSERT INTO peminjaman (user_id, buku_id, tgl_pinjam, tgl_kembali) VALUES ('$username', '$judul', '$pinjam', '$kembali')";
    $queryupdate = "UPDATE buku SET stok=stok-1 WHERE id='$id'";

    mysqli_query($conn, $querypinjam);
    mysqli_query($conn, $queryupdate);

    header("location: ". BASEURL . "public/user.php");
    exit();
}