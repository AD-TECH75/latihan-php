<?php
session_start();
?>
<h1>Langkah 2: membaca Session</h1>
<?php if (isset($_SESSION['nama_pengunjung'])): ?>
    <p>server masih ingat anda</p>
    <p>Halo <strong><?= $_SESSION['nama_pengunjung'] ?></strong> dari kelas <?= $_SESSION['kelas'] ?></p>
    <p>Anda membuat sesi ini pada jam: <?= $_SESSION['waktu_akses'] ?></p>
<?php else: ?>
    <p>server mengalami amnesia</p>
<?php endif; ?>

<a href="index.php">ke langkah 1</a>
<a href="hapus_session.php">ke langkah 3</a>