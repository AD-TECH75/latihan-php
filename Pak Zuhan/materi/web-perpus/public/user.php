<?php
session_start();
require_once "../includes/koneksi.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "user") {
    header("Location: login.php");
    exit;
}

$tabel = isset($_POST["tabel"]) ? $_POST["tabel"] : "anggota";
$data = mysqli_query($conn, "SELECT * FROM $tabel");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard User</title>
  <link rel="stylesheet" href="../assets/style/user.css">
</head>
<body>
  <div class="header">
    <h1>Hai, <?= $_SESSION["username"] ?></h1>
    <a href="logout.php" class="btn-logout">Logout</a>
  </div>
  <div class="content">
    <form method="POST" class="form-table">
      <label>Pilih tabel: </label>
      <select name="tabel">
        <option value="anggota" <?= $tabel=="anggota"?"selected":"" ?>>Anggota</option>
        <option value="buku" <?= $tabel=="buku"?"selected":"" ?>>Buku</option>
        <option value="pegawai" <?= $tabel=="pegawai"?"selected":"" ?>>Pegawai</option>
        <option value="pengarang" <?= $tabel=="pengarang"?"selected":"" ?>>Pengarang</option>
        <option value="koleksi" <?= $tabel=="koleksi"?"selected":"" ?>>Koleksi</option>
        <option value="pinjam" <?= $tabel=="pinjam"?"selected":"" ?>>Pinjam</option>
      </select>
      <button type="submit">Tampilkan</button>
      <a href="export_pdf.php?tabel=<?= $tabel ?>" class="btn">Export PDF</a>
    </form>

    <div class="table-container">
      <table>
        <tr>
          <?php while ($field = mysqli_fetch_field($data)): ?>
            <th><?= $field->name ?></th>
          <?php endwhile; ?>
        </tr>
        <?php
        mysqli_data_seek($data, 0);
        if (mysqli_num_rows($data) > 0) {
          while ($row = mysqli_fetch_assoc($data)) {
            echo "<tr>";
            foreach ($row as $val) echo "<td>$val</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='100%'>Tidak ada data</td></tr>";
        }
        ?>
      </table>
    </div>
  </div>
</body>
</html>
