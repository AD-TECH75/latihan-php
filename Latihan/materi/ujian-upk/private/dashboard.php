<?php include '../config/connection.php' ?>
<?php

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" id="htmlpage">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>

	<!-- dashboard css -->
	<link rel="stylesheet" href="<?= BASEURL ?>assets/css/dashboard.css" />

	<!-- bootstrap -->
	<?php include BASEPATH . "views/bootstrap.php" ?>
</head>

<body class="bg-primary">
	<header><?php include BASEPATH . 'views/template/header.php' ?></header>

	<main>
		<section class="container-fluid mt-5 animate__animated animate__fadeInUp">
			<div class="card card-body justify-content-center">
				<div class="box d-flex">
					<h2>Daftar Buku</h2>
					<a class="btn btn-primary ms-auto" href="<?= BASEURL ?>app/tambah.php">Tambah Buku Baru</a>
				</div>

				<?php if (isset($_GET['error'])): ?>
					<div class="alert alert-danger text-center text-capitalize auto-hide mt-2">
						<?php
						$message = match ($_GET['error']) {
							'hapus' => 'gagal menghapus buku',
							'edit' => 'gagal mengedit buku',
							'tambah' => 'gagal menambahkan buku',
							default => 'terjadi kesalahan. Silakan coba lagi.'
						};

						echo htmlspecialchars($message);
						?>
					</div>
				<?php endif; ?>

				<?php if (isset($_GET['success'])): ?>
					<div class="alert alert-success text-center text-capitalize auto-hide mt-2">
						<?php
						$message = match ($_GET['success']) {
							'hapus' => 'berhasil menghapus buku',
							'edit' => 'berhasil mengedit buku',
							'tambah' => 'berhasil menambahkan buku',
							default => 'berhasil melakukan operasi.'
						};

						echo htmlspecialchars($message);
						?>
					</div>
				<?php endif; ?>

				<div class="box">
					<div class="row row-cols-3 g-2 mt-2">
						<?php
						$query = "SELECT * FROM buku";
						$result = mysqli_prepare($conn, $query);
						mysqli_stmt_execute($result);
						$result = mysqli_stmt_get_result($result);
						while ($row = mysqli_fetch_assoc($result)):
							?>
							<div class="col animate__animated animate_fadeInUp">
								<div class="card card-body">
									<span class="left-line"></span>
									<h3><?= htmlspecialchars($row['judul']) ?></h3>
									<p class="mb-1"><strong>Pengarang:</strong> <?= htmlspecialchars($row['pengarang']) ?>
									</p>
									<p class="mb-1"><strong>Tahun:</strong> <?= $row['tahun'] ?></p>

									<div class="d-flex gap-2">
										<form action="<?= BASEURL ?>app/edit.php" method="post">
											<input type="hidden" name="id" value="<?= $row['id'] ?>">
											<button class="btn btn-warning" type="submit" name="update">Edit</button>
										</form>

										<form action="<?= BASEURL ?>app/hapus.php" method="post">
											<input type="hidden" name="id" value="<?= $row['id'] ?>">
											<button class="btn btn-danger" type="submit" name="delete">Hapus</button>
										</form>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</section>
	</main>
</body>
<script src="<?= BASEURL ?>assets/js/dashboard.js"></script>

</html>