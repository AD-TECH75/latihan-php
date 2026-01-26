<?php
require '../config/config.php';

if (!isset($_GET['id'])) {
    header('loaction:' . BASE_URL);
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = "SELECT * FROM barang WHERE id=?";
$result = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($result, "i", $id);
mysqli_stmt_execute($result);
$result = mysqli_stmt_get_result($result);
$barang = mysqli_fetch_assoc($result);

if (!$barang) {
    showMessage('danger', 'data barang tidak di temukan');
    header('loaction:' . BASE_URL . "app/barang.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $namaBarang = mysqli_escape_string($koneksi, $_POST['namaBarang']);
    $kategori = mysqli_escape_string($koneksi, $_POST['kategori']);
    $harga = mysqli_escape_string($koneksi, $_POST['hargaBarang']);
    $stok = mysqli_escape_string($koneksi, $_POST['stok']);
    $deskripsi = mysqli_escape_string($koneksi, $_POST['deskripsi']);

    mysqli_autocommit($koneksi, false);

    $query = "UPDATE barang SET nama_barang=?, kategori=?, harga=?, stok=?, deskripsi=? WHERE id=?";
    $result = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($result, "ssiisi", $namaBarang, $kategori, $harga, $stok, $deskripsi, $id);
    $check = mysqli_stmt_execute($result);

    if ($check) {
        mysqli_commit($koneksi);
        showMessage('success', 'Data Barang Behasil update');
        header('location:' . BASE_URL . 'app/barang.php');
    } else {
        mysqli_rollback($koneksi);
        showMessage('danger', 'Data Barang Gagal update' . mysqli_error($koneksi));
        header('location:' . BASE_URL . 'app/barang.php');
    }
}

require BASE_PATH . 'template/header.php';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase">update barang</h1>
                </div>
            </div><!-- /.row -->
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_barang" class="text-capitalize">nama barang</label>
                                <input type="text" name="namaBarang" id="namaBarang" class="form-control" placeholder="nama barang" value="<?= htmlspecialchars($barang['nama_barang']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori" class="text-capitalize">kategori</label>
                                <select class="custom-select" name="kategori" id="kategori" required>
                                    <option value="" class="text-capitalize" hidden>pilih kategori</option>
                                    <option value="elektronik" class="text-capitalize" <?= ($barang['kategori'] == "elektronik") ? 'selected' : ''; ?>>elektronik</option>
                                    <option value="furnitur" class="text-capitalize" <?= ($barang['kategori'] == "furnitur") ? 'selected' : ''; ?>>furnitur</option>
                                    <option value="aksesoris" class="text-capitalize" <?= ($barang['kategori'] == "aksesoris") ? 'selected' : ''; ?>>aksesoris</option>
                                    <option value="lainnya" class="text-capitalize" <?= ($barang['kategori'] == "lainnya") ? 'selected' : ''; ?>>lainnya...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_barang" class="text-capitalize">harga barang (rp.)</label>
                                <input type="number" name="hargaBarang" id="hargaBarang" class="form-control" placeholder="harga barang" value="<?= htmlspecialchars($barang['harga']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="stok" class="text-capitalize">stok</label>
                                <input type="number" name="stok" id="stok" placeholder="stok" class="form-control" value="<?= htmlspecialchars($barang['stok']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="text-capitalize">deskripsi barang</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" required><?= htmlspecialchars($barang['deskripsi']) ?></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $barang['id'] ?>">
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
<?php
require BASE_PATH . "template/footer.php"
?>