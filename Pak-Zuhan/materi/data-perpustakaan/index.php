<?php include "connection.php" ?>
<?php
$tabel = $_POST["tabel"] ?? "";
$kolom = [];
$data = false;

if (isset($_POST['tambah'])) {
    $tabel = $_POST['tabel'];
    $cols = [];
    $vals = [];

    foreach ($_POST as $key => $val) {
        if ($key !== 'tambah' && $key !== 'tabel') {
            $cols[] = "`$key`";
            $vals[] = "'" . mysqli_real_escape_string($con, $val) . "'";
        }
    }

    if (!empty($cols)) {
        $sql = "INSERT INTO `$tabel` (" . implode(',', $cols) . ") VALUES (" . implode(',', $vals) . ")";
        mysqli_query($con, $sql); // error handling diabaikan (sesuai permintaan)
        // Redirect biar data baru muncul & hindari duplicate submit
        header("Location: ?tabel=" . urlencode($tabel));
        exit;
    }
}

if ($tabel) {
    $data = mysqli_query($con, "SELECT * FROM `$tabel`");
    if ($data) {
        $kolom = [];
        $field_count = mysqli_num_fields($data);
        for ($i = 0; $i < $field_count; $i++) {
            $kolom[] = mysqli_fetch_field_direct($data, $i)->name;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-4">
        <form method="POST" class="d-flex align-items-center flex-wrap gap-3">
            <h2 class="mb-0">Pilih tabel :</h2>
            <select name="tabel" class="form-select w-auto" style="min-width: 150px;">
                <option value="">-- Pilih --</option>
                <option value="anggota" <?= $tabel == "anggota" ? "selected" : "" ?>>anggota</option>
                <option value="buku" <?= $tabel == "buku"      ? "selected" : "" ?>>buku</option>
                <option value="koleksi" <?= $tabel == "koleksi"   ? "selected" : "" ?>>koleksi</option>
                <option value="pegawai" <?= $tabel == "pegawai"   ? "selected" : "" ?>>pegawai</option>
                <option value="pengarang" <?= $tabel == "pengarang" ? "selected" : "" ?>>pengarang</option>
                <option value="pinjam" <?= $tabel == "pinjam"    ? "selected" : "" ?>>pinjam</option>
            </select>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>

        <div class="content mt-3">
            <?php if ($data && $tabel) { ?>
                <table class="table table-bordered table-striped">
                    <thead class="table table-dark">
                        <tr>
                            <?php foreach ($kolom as $nama_kolom) { ?>
                                <th><?= htmlspecialchars($nama_kolom) ?></th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody class="table table-light">
                        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <?php foreach ($kolom as $nama_kolom) { ?>
                                    <th><?= htmlspecialchars($row[$nama_kolom]) ?></th>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>

        <div class="p-3 bg-white rounded shadow-sm mb-4">
            <h6 class="fw-bold text-secondary mb-2">Tambah Data ke: <?= htmlspecialchars($tabel) ?></h6>
            <form method="POST" class="d-flex flex-wrap align-items-end gap-2">
                <input type="hidden" name="tabel" value="<?= htmlspecialchars($tabel) ?>">

                <?php foreach ($kolom as $col): ?>
                    <div class="flex-fill" style="min-width: 120px;">
                        <input
                            type="text"
                            name="<?= htmlspecialchars($col) ?>"
                            class="form-control"
                            placeholder="<?= htmlspecialchars($col) ?>"
                            required>
                    </div>
                <?php endforeach; ?>

                <button type="submit" name="tambah" value="1" class="btn btn-success">
                    Tambah
                </button>
            </form>
        </div>
</body>

</html>