<?php
include "config.php";

// Cek metode request
$method = $_SERVER['REQUEST_METHOD'];

// --- 1. LOGIKA READ (GET) ---
// Bagian ini akan otomatis jalan saat file ini di-include di index.php
$sql_get = "SELECT * FROM produk ORDER BY id_produk DESC";
$result = mysqli_query($conn, $sql_get);
$data_produk = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_produk[] = $row;
    }
}

// --- 2. LOGIKA CREATE & UPDATE (POST) ---
if ($method == 'POST' && isset($_POST['btn_simpan'])) {
    $id = $_POST['id_produk'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $harga = $_POST['harga'];
    $id_k = $_POST['id_kategori'];

    if ($id == "") {
        // Jika ID kosong, berarti data baru (Create)
        $sql = "INSERT INTO produk (nama_produk, harga, id_kategori) VALUES ('$nama', '$harga', '$id_k')";
    } else {
        // Jika ID ada, berarti update data lama (Update)
        $sql = "UPDATE produk SET nama_produk='$nama', harga='$harga', id_kategori='$id_k' WHERE id_produk='$id'";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?status=sukses");
    } else {
        echo "Gagal memproses data: " . mysqli_error($conn);
    }
    exit();
}

// --- 3. LOGIKA DELETE (GET Parameter) ---
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $sql_del = "DELETE FROM produk WHERE id_produk='$id_hapus'";
    
    if (mysqli_query($conn, $sql_del)) {
        header("Location: index.php?status=terhapus");
    } else {
        echo "Gagal menghapus: " . mysqli_error($conn);
    }
    exit();
}
?>