<?php 
// cek menggunakan method apa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // cek apakah data yang dikirim ada
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // cek email dan password harus sesuai
        if ($email === "123@gmail.com" && $password === 'rahasia') {
            echo "selamat datang kembali, $email";
        } else {
            echo "email $email tidak ada dalam database";
        }
    }
} else if (isset($_GET['email']) && isset($_GET['nama'])) {
    $nama = $_GET['nama'];
    $email = $_GET['email'];

    echo "selamat, email $email telah terdaftar atas nama $nama";
}
?>