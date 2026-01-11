<?php include 'data.php'; ?>

<div class="container">
    <?php foreach ($profil as $key => $user): ?>
        <div class="card">
            <h3><?= htmlspecialchars(ucfirst($user['name'])) ?></h3>
            <p>Age: <?= htmlspecialchars($user['age']) ?></p>
            <p>Status: <strong><?= htmlspecialchars($user['status']) ?></strong></p>

            <?php if ($user['age'] <= 20): ?>
                <p><small>Kategori: Junior</small></p>
            <?php else: ?>
                <p><small>Kategori: senior</small></p>
            <?php endif; ?>

            <?php if ($user['activate']): ?>
                <span class="status-badge bg-green">Aktif</span>
            <?php else: ?>
                <span class="status-badge bg-red">Nonaktif</span>
                <p class="warning">⚠️ Akun ditangguhkan!</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>