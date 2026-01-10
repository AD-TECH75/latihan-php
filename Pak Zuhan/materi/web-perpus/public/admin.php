<?php
session_start();
require_once "../includes/koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

$tables = ['anggota', 'buku', 'pegawai', 'pengarang', 'koleksi', 'pinjam'];
$selected_table = $_POST['table_name'] ?? '';
$data = [];

if ($selected_table) {
  $query = "SELECT * FROM $selected_table";
  $result = mysqli_query($conn, $query);
  if ($result) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="../assets/style/admin.css">
</head>

<body>
  <div class="header">
    <h1>Admin Panel</h1>
    <div class="header-right">
      <a href="manage_user.php" class="btn-manage">Kelola User</a>
      <a href="logout.php" class="logout-btn">Logout</a>
    </div>
  </div>

  <div class="content">
    <h2>Kelola Database</h2>

    <form method="POST" class="form-table">
      <select name="table_name" required>
        <option value="">-- Pilih Tabel --</option>
        <?php foreach ($tables as $table): ?>
          <option value="<?= $table ?>" <?= $selected_table === $table ? 'selected' : '' ?>><?= ucfirst($table) ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">Tampilkan</button>
      <?php if ($selected_table): ?>
        <a href="export_pdf.php?table=<?= $selected_table ?>" class="btn">Export PDF</a>
      <?php endif; ?>
    </form>

    <?php if ($selected_table): ?>
      <div class="table-container">
        <table>
          <tr>
            <?php foreach (array_keys($data[0] ?? []) as $col): ?>
              <th><?= $col ?></th>
            <?php endforeach; ?>
            <th>Aksi</th>
          </tr>

          <?php if (!empty($data)): ?>
            <?php foreach ($data as $row): ?>
              <tr>
                <?php foreach ($row as $value): ?>
                  <td><?= htmlspecialchars($value) ?></td>
                <?php endforeach; ?>
                <td>
                  <form action="hapus_tabel.php" method="POST" style="display:inline;">
                    <input type="hidden" name="table_name" value="<?= $selected_table ?>">
                    <input type="hidden" name="key_col" value="<?= array_keys($row)[0] ?>">
                    <input type="hidden" name="key_val" value="<?= $row[array_keys($row)[0]] ?>">
                    <button class="danger" type="submit" onclick="return confirm('Hapus data ini?')">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="100%" style="text-align:center;">Tidak ada data</td>
            </tr>
          <?php endif; ?>
        </table>
      </div>

      <br>
      <h3>Tambah Data ke Tabel: <?= ucfirst($selected_table) ?></h3>
      <form action="tambah_tabel.php" method="POST" class="form-add">
        <input type="hidden" name="table_name" value="<?= $selected_table ?>">
        <?php
        // ambil struktur kolom
        $desc = mysqli_query($conn, "DESC $selected_table");
        while ($col = mysqli_fetch_assoc($desc)) {
          $field = $col['Field'];
          echo "<input type='text' name='fields[$field]' placeholder='$field'>";
        }
        ?>
        <button type="submit">Tambah</button>
      </form>
    <?php endif; ?>
  </div>
</body>

</html>