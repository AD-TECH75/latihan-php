<?php
require '../config/config.php';
require BASE_PATH . 'app/barang/filter.php';
require BASE_PATH . 'template/header.php';

// Ambil parameter pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Ambil data dengan filter
$result = getBarang($keyword, $kategori_filter);

// Ambil semua kategori untuk dropdown
$kategori_list = getKategori();

$message = getMessage();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase">data barang</h1>
                </div>
            </div><!-- /.row -->
        </div>
        <div class="content">
            <div class="container-fluid">
                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible">

                        <button type="button" class="close" data-dismiss="alert" aria-
                            hidden="true">&times;</button>

                        <?php echo $message['text']; ?>
                    </div>
                <?php endif; ?>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pencarian dan Filter</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="barang.php" class="form-inline">
                            <div class="form-group mb-2 mr-2">
                                <label for="keyword" class="sr-only">Kata Kunci</label>
                                <input type="text" class="form-control" id="keyword" name="keyword"
                                    placeholder="Cari nama barang..." value="<?php echo htmlspecialchars($keyword); ?>">
                            </div>
                            <div class="form-group mb-2 mr-2">
                                <label for="kategori" class="sr-only">Kategori</label>
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value="semua">Semua Kategori</option>
                                    <?php foreach ($kategori_list as $kat): ?>
                                        <option value="<?php echo htmlspecialchars($kat); ?>"
                                            <?php echo ($kategori_filter == $kat) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($kat); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mb-2 mr-2">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="barang.php" class="btn btn-secondary mb-2">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Isi dari data barang</h3>
                        <div class="card-tools">
                            <a href="<?= BASE_URL ?>app/barang/print.php" class="btn btn-primary btn-sm">
                                <i class="fas fa-print"></i>
                                Cetak Data Barang
                            </a>
                            <a href="<?= BASE_URL ?>app/barang/tambah.php" class="btn btn-primary btn-sm text-capitalize">
                                <i class="fas fa-plus"></i>
                                tambah barang
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <p>ditemukan <?= mysqli_num_rows($result) ?> data barang</p>
                            <?php if (!empty($keyword)): ?>
                                dengan kata kunci "<?php echo htmlspecialchars($keyword); ?>
                            <?php endif; ?>
                            <div class="table-responsive" style="max-height: 340px; overflow-y: auto;">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead class="sticky-top bg-white">
                                        <tr class="text-center">
                                            <th>no</th>
                                            <th>Nama barang</th>
                                            <th>Kategori</th>
                                            <th>harga</th>
                                            <th>Stok</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $query = "SELECT * FROM barang ORDER BY id DESC";
                                        // $result = mysqli_query($koneksi, $query);
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)):
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= htmlspecialchars($row['nama_barang']); ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info"><?= htmlspecialchars($row['kategori']); ?></span>
                                                </td>
                                                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-<?= ($row['stok'] > 0) ? 'success' : 'danger'; ?>">
                                                        <?= $row['stok']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?= substr(htmlspecialchars($row['deskripsi']), 0, 50); ?>...</td>
                                                <td>
                                                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="alert alert-warning text-center">
                                    <i class="fas fa-exclamation-triangle"></i> <label> Tidak ada data barang ditemukan.</label>
                                    <?php if (!empty($keyword)): ?>
                                        Coba dengan kata kunci lain.
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>

<?php
require BASE_PATH . "template/footer.php";
?>