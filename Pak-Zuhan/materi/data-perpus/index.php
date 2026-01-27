<?php
//connection database
$host = "localhost";
$user = "root";
$pass = "";
$db = "perpustakaan_db";
$connection = mysqli_connect($host, $user, $pass, $db);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

//mengambil data 
$data_anggota = mysqli_query($connection, "SELECT * FROM anggota LIMIT 3");
$semua_anggota = mysqli_fetch_all($data_anggota, MYSQLI_ASSOC);
// tutup koneksi setelah mengambil data
mysqli_close($connection);
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Anggota Perpustakaan</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        tbody tr:nth-child(even) { background: #fbfbfb; }
    </style>
</head>
<body>
    <h1>Data Anggota</h1>

<?php if (empty($semua_anggota)): ?>
    <p>Tidak ada data anggota.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>No Anggota</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($semua_anggota as $anggota): ?>
            <tr>
                <td><?php echo htmlspecialchars($anggota['no_anggota']); ?></td>
                <td><?php echo htmlspecialchars($anggota['nama_anggota']); ?></td>
                <td><?php echo htmlspecialchars($anggota['alamat_anggota']); ?></td>
                <td><?php echo htmlspecialchars($anggota['no_telp']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>


