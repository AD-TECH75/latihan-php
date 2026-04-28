<?php
include "config.php";

// --- PROSES BACKEND ---

// 1. Tambah & Update Data
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $id_k  = $_POST['id_kategori'];
    $id_p  = $_POST['id_produk'];

    // Sanitasi input sederhana agar tidak error jika ada tanda petik
    $nama = mysqli_real_escape_string($conn, $nama);

    if ($id_p == "") {
        // Mode Tambah (CREATE)
        $sql = "INSERT INTO produk (nama_produk, harga, id_kategori) VALUES ('$nama', '$harga', '$id_k')";
    } else {
        // Mode Update (UPDATE)
        $sql = "UPDATE produk SET nama_produk='$nama', harga='$harga', id_kategori='$id_k' WHERE id_produk='$id_p'";
    }
    
    if(mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// 2. Hapus Data (DELETE)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id'");
    header("Location: index.php");
}

// 3. Ambil Data untuk Form Edit
$edit_data = ['id_produk' => '', 'nama_produk' => '', 'harga' => '', 'id_kategori' => ''];
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id'");
    $edit_data = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Produk Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?= $edit_data['id_produk'] ? 'Edit Produk' : 'Tambah Produk' ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id_produk" value="<?= $edit_data['id_produk'] ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" value="<?= $edit_data['nama_produk'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control" value="<?= $edit_data['harga'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ID Kategori</label>
                            <input type="number" name="id_kategori" class="form-control" value="<?= $edit_data['id_kategori'] ?>" placeholder="Masukkan angka">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="simpan" class="btn btn-success">Simpan Data</button>
                            <?php if ($edit_data['id_produk']): ?>
                                <a href="index.php" class="btn btn-secondary">Batal</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Daftar Produk</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // QUERY TANPA JOIN (Karena tabel kategori tidak ada)
                            $sql = "SELECT * FROM produk ORDER BY id_produk DESC";
                            $result = mysqli_query($conn, $sql);
                            
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)):
                            ?>
                            <tr>
                                <td><?= $row['id_produk'] ?></td>
                                <td><?= $row['nama_produk'] ?></td>
                                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td><span class="badge bg-secondary"><?= $row['id_kategori'] ?></span></td>
                                <td class="text-center">
                                    <a href="index.php?edit=<?= $row['id_produk'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="index.php?hapus=<?= $row['id_produk'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                            <?php 
                                endwhile; 
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>Belum ada data produk.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>