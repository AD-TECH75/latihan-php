<?php
require "../../config/config.php";
require BASE_PATH . "app/barang/filter.php";

$keyword = isset($_GET['keyword']) ?? "";
$kategori = isset($_GET['kategori']) ?? "";

$result = getBarang($keyword, $kategori);

require_once BASE_PATH . "template/header.php";
?>
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card-body,
        .card-body * {
            visibility: visible;
        }
        .card-body {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-uppercase">Print Data Barang</h1>
                </div>
            </div><!-- /.row -->
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Print Data</h3>
                        <div class="card-tools">
                            <a onclick="window.print()" class="btn btn-primary btn-sm text-capitalize">
                                <i class="fas fa-print"></i>
                                print
                            </a>
                            <a href="<?= BASE_URL ?>private/barang.php" class="btn btn-secondary btn-sm text-capitalize">
                                <i class="fas fa-arrow-left"></i>
                                kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div>
                            <h1 class="text text-center text-bold text-uppercase">laporan data barang</h1>
                            <p class="text text-center text-capitalize">pada tanggal: <?= date('d/m/Y') ?> jam <?= date('H:i:s') ?></p>
                        </div>

                        <div class="card p-2">
                            <p class="text text-capitalize text-bold m-0">
                                filter :
                                <?php
                                if (empty($keyword) && empty($kategori_filter)) echo ' Tidak ada filter khusus ';
                                if (!empty($keyword)) echo ' Kata kunci "' . htmlspecialchars($keyword) . '"';
                                if (!empty($kategori_filter) && $kategori_filter != 'semua') echo ' Kategori " ' . htmlspecialchars($kategori_filter) . ' "';
                                ?>
                            </p>
                            <p class="text text-capitalize text-bold m-0">total data : <?= mysqli_num_rows($result) ?> barang</p>
                        </div>

                        <table class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th class="text text-capitalize">No</th>
                                    <th class="text text-capitalize">nama barang</th>
                                    <th class="text text-capitalize">kategori</th>
                                    <th class="text text-capitalize">harga</th>
                                    <th class="text text-capitalize">stok</th>
                                    <th class="text text-capitalize">deskripsi</th>
                                    <th class="text text-capitalize">tanggal input</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total_harga = 0;
                                $total_stok = 0;

                                while ($row = mysqli_fetch_assoc($result)):
                                    $total_harga += $row['harga'] * $row['stok'];
                                    $total_stok += $row['stok'];
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                        <td><?= htmlspecialchars($row['kategori']) ?></td>
                                        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                        <td><?= htmlspecialchars($row['stok']) ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                                    </tr>
                                <?php endwhile; ?>

                                <!-- total -->
                                <tr class="bg-primary bg-opacity-10">
                                    <td colspan="3" class="text text-uppercase">total</td>
                                    <td>Rp <?= number_format($total_harga, 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($total_stok) ?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-3">
                            <p class="text text-uppercase text-bold m-0">ringkasan :</p>
                            <p class="text text-capitalize m-0">total data : <?= ($no - 1) ?> barang</p>
                            <p class="text text-capitalize m-0">total nilai barang : Rp <?= number_format($total_harga, 0, ',', '.') ?></p>
                            <p class="text text-capitalize m-0">rata-rata harga : Rp <?= number_format(($no > 1) ? $total_harga / ($no - 1) : 0, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . "template/footer.php";  ?>