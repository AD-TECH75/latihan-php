<?php
include '../config/connection.php';
session_start();

// Validasi session
if (!isset($_SESSION['id']) || !is_numeric($_SESSION['id'])) {
    header("Location: " . BASEURL . "login.php");
    exit();
}

// Cek apakah form disubmit
if (!isset($_POST['submit'])) {
    header("Location: " . BASEURL . "public/user.php?pinjam=error");
    exit();
}

// Ambil & validasi input
$idUser = (int) $_SESSION['id'];
$idBuku = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
$day = filter_var($_POST['day'] ?? null, FILTER_VALIDATE_INT);
$jumlah = filter_var($_POST['jumlah'] ?? null, FILTER_VALIDATE_INT);

// Validasi input wajib
if ($idBuku === false || $day === false || $jumlah === false) {
    header("Location: " . BASEURL . "public/user.php?pinjam=error");
    exit();
}

// Validasi nilai
if ($day < 1 || $day > 183) {
    header("Location: " . BASEURL . "public/user.php?pinjam=error");
    exit();
}
if ($jumlah < 1) {
    header("Location: " . BASEURL . "public/user.php?pinjam=error");
    exit();
}

// mengecek stok
$querystock = "SELECT stok FROM buku WHERE id=?";
$stmtstock = mysqli_prepare($conn, $querystock);
mysqli_stmt_bind_param($stmtstock, "i", $idBuku);
mysqli_stmt_execute($stmtstock);
$buku = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtstock));

if (!$buku || (int) $buku['stok'] < 0) {
    mysqli_autocommit($conn, TRUE);
    header("Location: " . BASEURL . "public/user.php?pinjam=error");
    exit();
}

// Hitung tanggal
$pinjam = date('Y-m-d');
$kembali = date('Y-m-d', strtotime("+$day days"));

// mengecek apakah sudah ada peminjaman aktif dengan buku dan tanggal pengumpulan yang sama
$query2 = "SELECT id, jumlah FROM peminjaman WHERE user_id=? AND buku_id=? AND tgl_kembali=? AND status='dipinjam' LIMIT 1";
$stmt2 = mysqli_prepare($conn, $query2);
mysqli_stmt_bind_param($stmt2, "iis", $idUser, $idBuku, $kembali);
mysqli_stmt_execute($stmt2);
$exiting = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt2));

// Transaksi database
mysqli_autocommit($conn, FALSE);

// jika ada maka akan update
if ($exiting) {
    // mengupdate jumlah
    $newjumlah = (int) $exiting["jumlah"] + $jumlah;
    $queryjumlah = "UPDATE peminjaman SET jumlah=? WHERE id=?";
    $stmt4 = mysqli_prepare($conn, $queryjumlah);
    mysqli_stmt_bind_param($stmt4, "ii", $newjumlah, $exiting["id"]);
    $ok1 = mysqli_stmt_execute($stmt4);
} else {
    // Simpan peminjaman
    $queryinsert = "INSERT INTO peminjaman (user_id, buku_id, jumlah, tgl_pinjam, tgl_kembali, status) VALUES (?, ?, ?, ?, ?, 'dipinjam')";
    $stmtinsert = mysqli_prepare($conn, $queryinsert);
    mysqli_stmt_bind_param($stmtinsert, "iiiss", $idUser, $idBuku, $jumlah, $pinjam, $kembali);
    $ok1 = mysqli_stmt_execute($stmtinsert);
}

// Kurangi stok
$querystock = "UPDATE buku SET stok = stok - ? WHERE id = ?";
$stmtstock = mysqli_prepare($conn, $querystock);
mysqli_stmt_bind_param($stmtstock, "ii", $jumlah, $idBuku);
$ok2 = mysqli_stmt_execute($stmtstock);

if ($ok1 && $ok2) {
    mysqli_commit($conn);
    header("Location: " . BASEURL . "public/user.php?pinjam=success");
} else {
    mysqli_rollback($conn);
    header("Location: " . BASEURL . "public/user.php?pinjam=error");
}

mysqli_close($conn);
exit();
?>