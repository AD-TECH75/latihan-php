<?php
// --- Bagian PHP: Ambil daftar FILE saja dari folder 'materi' ---
$folder = 'materi/';
$files = [];

if (is_dir($folder)) {
    foreach (scandir($folder) as $item) {
        if ($item === '.' || $item === '..') continue;
        $fullPath = $folder . $item;
        if (is_file($fullPath)) { // Hanya file, bukan folder
            $files[] = [
                'name' => $item,
                'path' => $fullPath
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>📂 File Explorer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0a0a0a;
            color: #e0f7ff;
            line-height: 1.7;
            padding: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px;
            background: linear-gradient(135deg, #001e3c, #0a0a0a);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 180, 255, 0.1);
        }
        header h1 {
            font-size: 2.5rem;
            color: #87cefa;
            text-shadow: 0 0 10px rgba(135, 206, 250, 0.4);
        }
        header p.subtitle {
            color: #b0e0ff;
            font-size: 1.1rem;
            margin-top: 10px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background-color: #111;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 150, 255, 0.15);
        }
        .file-list {
            list-style: none;
            margin-top: 20px;
        }
        .file-list li {
            margin: 12px 0;
            padding: 14px;
            background-color: #1a1a1a;
            border-left: 4px solid #87cefa;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .file-list li:hover {
            background-color: #151515;
            transform: translateX(5px);
            box-shadow: 0 0 10px rgba(135, 206, 250, 0.2);
        }
        .file-list a {
            color: #87cefa;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
        }
        .file-list a:hover {
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
        footer a {
            color: #87cefa;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        @media (max-width: 600px) {
            .container { padding: 20px; }
            header { padding: 20px; }
        }
    </style>
</head>
<body>
    <header>
        <h1>📂 File Explorer</h1>
        <p class="subtitle">Akses semua file Anda</p>
    </header>

    <div class="container">
        <h2>📄 File Tersedia</h2>
        <ul class="file-list" id="fileList">
            <!-- Diisi oleh JavaScript -->
        </ul>
    </div>

    <footer>
        &copy; 2025 File Explorer. <a href="index.php">Beranda</a>.
    </footer>

    <script>
        // Data file dari PHP (hanya file, tanpa folder)
        const fileData = <?php echo json_encode($files); ?>;

        const list = document.getElementById('fileList');

        if (fileData.length === 0) {
            list.innerHTML = '<li class="file"><a href="#">📄 Tidak ada file ditemukan di folder "materi"</a></li>';
        } else {
            fileData.forEach(file => {
                const li = document.createElement('li');
                li.className = 'file';
                li.innerHTML = `<a href="${file.path}">📄 ${file.name}</a>`;
                list.appendChild(li);
            });
        }
    </script>
</body>
</html>