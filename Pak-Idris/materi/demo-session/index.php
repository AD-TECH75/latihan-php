<?php
session_start();

$_SESSION['nama_pengunjung'] = "manusia";
$_SESSION['kelas'] = "XI-RPL";
$_SESSION['waktu_akses'] = date("H:i:s");
?>

<h1>langkah 1: membuat session </h1>
<p>session di buat</p>
<a href="baca_session.php">halaman 2</a>
<a href="hapus_session.php">halaman 3</a>