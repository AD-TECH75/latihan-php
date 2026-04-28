<?php htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8') ?>
<div class="mt-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h1 class="display-5">SELAMAT DATANG, <?= htmlspecialchars($data['username']) ?>!</h1>
            <hr>
            <p class="lead">Email Terdaftar: <strong><?= htmlspecialchars($data['email']) ?></strong></p>
            <p class="lead">Nomor Telepon: <strong><?= htmlspecialchars($data['nomor']) ?></strong></p>

            <a href="index.php" class="btn btn-outline-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>