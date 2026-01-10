<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");

$row = mysqli_fetch_assoc($data);

if (isset($_POST["update"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $kelas = htmlspecialchars($_POST["kelas"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    $query = "UPDATE siswa SET nama='$nama', kelas='$kelas', alamat='$alamat' WHERE id='$id'";
    mysqli_query($koneksi, $query);

    header("location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet'
        integrity='sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB' crossorigin='anonymous'>
</head>

<body>
    <main class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card card-body shadow col-10 col-sm-8 col-md-8 col-lg-4 p-4" style="width: 100%; max-width: 500px;">
            <h2 class="text text-center">Edit Data Siswa</h2>
            <form action="" method="post">
                <div class="mb-1">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?= $row['nama'] ?>" />
                </div>
                <div class="mb-1">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas" id="kelas" class="form-control" value="<?= $row['kelas'] ?>" />
                </div>
                <div class="mb-1">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"><?= $row['alamat'] ?></textarea>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>