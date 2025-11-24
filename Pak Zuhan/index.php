<?php
$guruName = basename(__DIR__); // Ambil nama folder guru (pak-A / pak-B)
$materiFolder = __DIR__ . '/materi';
$materiFolders = [];

if (is_dir($materiFolder)) {
    foreach (scandir($materiFolder) as $item) {
        if ($item === '.' || $item === '..') continue;
        $fullPath = $materiFolder . DIRECTORY_SEPARATOR . $item;
        if (is_dir($fullPath)) {
            $materiFolders[] = $item;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>📂 <?= htmlspecialchars($guruName) ?> - Materi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #0a0a0a;
            color: #e0f7ff;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: linear-gradient(135deg, #001e3c, #0a0a0a);
            border-radius: 12px;
        }
        header h1 { font-size: 2.5rem; color: #87cefa; }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background: #111;
            border-radius: 12px;
        }
        .materi-list {
            list-style: none;
        }
        .materi-list li {
            margin: 12px 0;
            padding: 14px;
            background: #1a1a1a;
            border-left: 4px solid #87cefa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .materi-list a {
            color: #87cefa;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
        }
        .materi-list a:hover {
            color: #b0e0ff;
            text-decoration: underline;
        }
        footer {
            text-align: center;
            margin-top: 50px;
            color: #666;
            font-size: 0.9rem;
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>📂 <?= htmlspecialchars($guruName) ?></h1>
        <p class="subtitle">Daftar Materi</p>
    </header>

    <div class="container">
        <h2>📚 Materi Tersedia</h2>
        <ul class="materi-list" id="materiList">
            <?php if (empty($materiFolders)): ?>
                <li><a href="#">📁 Belum ada materi</a></li>
            <?php else: ?>
                <?php foreach ($materiFolders as $materi): ?>
                    <li><a href="materi/<?= urlencode($materi) ?>/"><?= htmlspecialchars($materi) ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <footer>
        &copy; 2025 File Explorer. <a href="../index.php">Kembali ke Daftar Guru</a>.
    </footer>
</body>
</html>