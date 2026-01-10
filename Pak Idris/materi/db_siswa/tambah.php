<?php include 'koneksi.php' ?>

<?php
if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $simpan = "INSERT INTO siswa (nama, kelas, alamat) VALUES ('$nama', '$kelas', '$alamat')";

    mysqli_query($koneksi, $simpan);

    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB' crossorigin='anonymous'>
</head>

<body class="p-4">
    <main class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card card-body shadow col-10 col-sm-8 col-md-8 col-lg-4 p-4" style="width: 100%; max-width: 500px;">
            <h2 class="text text-center">Tambah Data Siswa</h2>
            <form action="" method="post">
                <div class="mb-1">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" />
                </div>
                <div class="mb-1">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas" id="kelas" class="form-control" />
                </div>
                <div class="mb-1">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>