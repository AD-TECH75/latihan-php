<?php
$baseFolder = __DIR__; // Folder latihan-php
$guruFolders = [];

// Cari semua folder di level atas (selain index.php dan hidden files)
foreach (scandir($baseFolder) as $item) {
    // Lewati file/folder tersembunyi (yang diawali titik), file index.php, dan direktori non-guru
    if ($item === '.' || $item === '..' || $item === 'index.php' || substr($item, 0, 1) === '.') {
        continue;
    }
    $fullPath = $baseFolder . DIRECTORY_SEPARATOR . $item;
    if (is_dir($fullPath)) {
        $guruFolders[] = $item;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>📂 File Explorer - Guru</title>
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
        .guru-list {
            list-style: none;
        }
        .guru-list li {
            margin: 12px 0;
            padding: 14px;
            background: #1a1a1a;
            border-left: 4px solid #87cefa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .guru-list a {
            color: #87cefa;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
        }
        .guru-list a:hover {
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
        <h1>📂 File Explorer - Guru</h1>
        <p class="subtitle">Pilih guru untuk melihat materi</p>
    </header>

    <div class="container">
        <h2>👨‍🏫 Daftar Guru</h2>
        <ul class="guru-list" id="guruList">
            <?php foreach ($guruFolders as $guru): ?>
                <li><a href="<?= htmlspecialchars($guru) ?>/index.php"><?= htmlspecialchars($guru) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <footer>
        &copy; 2025 File Explorer. <a href="index.php">Beranda</a>.
    </footer>
</body>
</html>