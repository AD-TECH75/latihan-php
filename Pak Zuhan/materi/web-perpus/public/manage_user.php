<?php
session_start();
require_once "../includes/koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    if (isset($_POST['ban'])) {
        mysqli_query($conn, "UPDATE user SET banned = 1 WHERE id = $id");
    } elseif (isset($_POST['unban'])) {
        mysqli_query($conn, "UPDATE user SET banned = 0 WHERE id = $id");
    } elseif (isset($_POST['hapus'])) {
        mysqli_query($conn, "DELETE FROM user WHERE id = $id");
    }
}

$result = mysqli_query($conn, "SELECT * FROM user");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>
    <link rel="stylesheet" href="../assets/style/admin.css">
</head>
<body>
    <div class="header">
        <h1>Kelola User</h1>
        <a href="admin.php" class="btn">Kembali</a>
    </div>

    <div class="content">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= ucfirst($row['role']) ?></td>
                    <td><?= $row['banned'] ? '❌ Diblokir' : '✅ Aktif' ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <?php if ($row['banned']): ?>
                                <button type="submit" name="unban">Unban</button>
                            <?php else: ?>
                                <button type="submit" name="ban">Ban</button>
                            <?php endif; ?>
                            <button type="submit" name="hapus" class="danger" onclick="return confirm('Hapus user ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
