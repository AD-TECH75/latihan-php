<?php
include './config/config.php';
include './template/header.php';

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
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Isi dari data barang</h3>
                                    <div class="card-tools">
                                        <a href="<?= BASE_URL ?>tambah.php" class="btn btn-primary btn-sm text-capitalize">tambah barang</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
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
                                            $query = "SELECT * FROM barang ORDER BY id DESC";
                                            $result = mysqli_prepare($koneksi, $query);
                                            mysqli_stmt_execute($result);
                                            $result = mysqli_stmt_get_result($result);
                                            $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)):
                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $row['nama_barang'] ?></td>
                                                    <td><?= $row['kategori'] ?></td>
                                                    <td><?= $row['harga'] ?></td>
                                                    <td><?= $row['stok'] ?></td>
                                                    <td><?= $row['deskripsi'] ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning">Edit</a>
                                                        <a href="#" class="btn btn-danger">hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
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
        </div>
    </div>
</div>

<?php

?>