<?php
include '../config/connection.php';
session_start();

// Validasi session
if (!isset($_SESSION['id']) || !is_numeric($_SESSION['id'])) {
    header("Location: " . BASEURL . "login.php");
    exit();
}

// Validasi input
if (!isset($_POST['pinjam_id']) || !is_numeric($_POST['pinjam_id'])) {
    header("Location: " . BASEURL . "public/user.php?kembali=error");
    exit();
}

$idpinjam = filter_var($_POST["pinjam_id"], FILTER_VALIDATE_INT);
$jumlahkembali = filter_var($_POST["jumlahkembali"], FILTER_VALIDATE_INT);
$iduser = (int) $_SESSION['id'];

if ($idpinjam === false || $jumlahkembali === false || $jumlahkembali < 0) {
    header("Location: " . BASEURL . "public/user.php?kembali=error");
    exit();
}

// mengambil data peminjaman
$querypinjam = "SELECT buku_id, jumlah FROM peminjaman WHERE id=? AND user_id=? AND status='dipinjam'";
$stmtpinjam = mysqli_prepare($conn, $querypinjam);
mysqli_stmt_bind_param($stmtpinjam, "ii", $idpinjam, $iduser);
mysqli_stmt_execute($stmtpinjam);
$datapinjam = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtpinjam));

if (!$datapinjam || $jumlahkembali > $datapinjam["jumlah"]) {
    header("Location: " . BASEURL . "public/user.php?kembali=error");
    exit();
}

$buku_id = (int) $datapinjam['buku_id'];
$jumlahpinjam = (int) $datapinjam['jumlah'];
$jumlahsisa = $jumlahpinjam - $jumlahkembali;

mysqli_autocommit($conn, false);

if ($jumlahsisa == 0) {
    // menghapus table jika jumlah nya 0
    $queryhapus = "DELETE FROM peminjaman WHERE id=?";
    $stmthapus = mysqli_prepare($conn, $queryhapus);
    mysqli_stmt_bind_param($stmthapus, "i", $idpinjam);
    $ok1 = mysqli_stmt_execute($stmthapus);
} else {
    // mengurangi table jumlah
    $queryupdate = "UPDATE peminjaman SET jumlah = ? WHERE id = ?";
    $stmupdate = mysqli_prepare($conn, $queryupdate);
    mysqli_stmt_bind_param($stmupdate, "ii", $jumlahsisa, $idpinjam);
    $ok1 = mysqli_stmt_execute($stmupdate);
}

// update jumlah buku
$querystock = "UPDATE buku SET stok = stok + ? WHERE id = ?";
$stmtstock = mysqli_prepare($conn, $querystock);
mysqli_stmt_bind_param($stmtstock, "ii", $jumlahkembali, $buku_id);
$ok2 = mysqli_stmt_execute($stmtstock);

if ($ok1 && $ok2) {
    mysqli_commit($conn);
    header("Location: " . BASEURL . "public/user.php?kembali=success");
} else {
    mysqli_rollback($conn);
    header("Location: " . BASEURL . "public/user.php?kembali=error");
}

mysqli_close($conn);
exit();
?>