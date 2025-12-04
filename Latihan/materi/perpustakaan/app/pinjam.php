<?php
include '../config/connection.php';

session_start();

// Validasi session
if (!isset($_SESSION['id']) || !is_numeric($_SESSION['id'])) {
    header("Location: " . BASEURL . "login.php");
    exit();
}

$idUser = (int) $_SESSION['id'];
$idBuku = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
$day = filter_var($_POST['day'] ?? null, FILTER_VALIDATE_INT);
$jumlah = filter_var($_POST['jumlah'] ?? null, FILTER_VALIDATE_INT);

// jika tidak mengisi
if (!isset($_POST['submit']) || !isset($_POST['id']) || !isset($_POST['day'])) {
    header("location: " . BASEURL . "public/user.php?error=missing_data");
    exit();
}

if (isset($_POST["submit"])) {
    // mengecek stok dari buku jika 0 maka akan error
    $stok = "SELECT stok FROM buku WHERE id=?";
    $stmtstock = mysqli_prepare($conn, $stok);
    mysqli_stmt_bind_param($stmtstock,"i", $idBuku);
    $resultstock = mysqli_stmt_get_result($stmtstock);
    $buku = mysqli_fetch_assoc($resultstock);

    if (!$buku) {
        // buku tidak ditemukan
        header("location: " . BASEURL . "public/user.php?error=out_of_stock");
        exit();
    }

    $stoktersedia = (int)$buku["stok"];

    if ($jumlah > $stoktersedia) {
        header("location: " . BASEURL . "public/user.php?error=over_stock");
        exit();
    }

    // memastikan tidak lebih dari 6 bulan
    if ($day < 1 || $day > 183) {
        header("location: " . BASEURL . "public/user.php?error=invalid_day");
        exit();
    }

    // menentukan tanggal pinjam
    $pinjam = date('Y-m-d');
    // menentukan tanggal kembali
    $kembali = date('Y-m-d', strtotime("+$day days"));

    // menggunakan prepare statement
    mysqli_autocommit($conn, FALSE);

    $querypinjam = "INSERT INTO peminjaman (user_id, buku_id, jumlah, tgl_pinjam, tgl_kembali) VALUES (?, ?, ?, ?, ?)";
    $prepare1 = mysqli_prepare($conn, $querypinjam);
    mysqli_stmt_bind_param($prepare1, "iiiss", $idUser, $idBuku, $jumlah, $pinjam, $kembali);
    $finalquery1 = mysqli_stmt_execute($prepare1);
    
    $queryupdate = "UPDATE buku SET stok=stok-? WHERE id=?";
    $prepare2 = mysqli_prepare($conn, $queryupdate);
    mysqli_stmt_bind_param($prepare2, "ii", $jumlah, $idBuku);
    $finalquery2 = mysqli_stmt_execute($prepare2);

    if ($finalquery1 && $finalquery2) {
        mysqli_commit($conn);
        header("location: " . BASEURL . "public/user.php?success=berhasil_pinjam");
        exit();
    } else {
        mysqli_rollback($conn);
        header("location: " . BASEURL . "public/user.php?error=gagal_pinjam");
        exit();
    }

    mysqli_autocommit($conn, TRUE);
    exit();
}