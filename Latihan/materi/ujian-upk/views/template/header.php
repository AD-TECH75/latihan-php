<link rel="stylesheet" href="<?= BASEURL ?>assets/css/header.css">
<nav class="navbar navbar-expand-lg bg-body-tertiary animate__animated animate__fadeInDown">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="<?= BASEURL ?>private/dashboard.php">Manajemen Buku Perpustakaan</a>

        <!-- Toggler -->
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center pt-3 pt-lg-0 align-items-lg-center">
                <!-- Welcome text -->
                <li class="nav-item d-lg-block">
                    <span class="text-capitalize me-2">
                        Selamat Datang, <strong class="text-primary">Admin</strong>!
                    </span>
                </li>

                <!-- Home -->
                <li class="nav-item">
                    <hr class="d-lg-none" />
                    <a class="nav-link d-lg-none" href="<?= BASEURL ?>private/dashboard.php">Home</a>
                    <a class="btn btn-primary d-none d-lg-inline me-2"
                        href="<?= BASEURL ?>private/dashboard.php">Home</a>
                </li>

                <!-- Tambah Buku -->
                <li class="nav-item">
                    <hr class="d-lg-none" />
                    <a class="nav-link d-lg-none text-primary" href="<?= BASEURL ?>app/tambah.php">Tambah Buku</a>
                    <a class="btn btn-outline-primary d-none d-lg-inline me-4"
                        href="<?= BASEURL ?>app/tambah.php">Tambah Buku</a>
                </li>

                <!-- toggle ganti tema -->
                <div class="row justify-content-center me-3 nav-item">
                    <hr class="d-lg-none">
                    <input type="checkbox" class="checkbox" id="checkbox">
                    <label for="checkbox" class="checkbox-label bg-gradient">
                        <i class="bi bi-moon-fill"></i>
                        <i class="bi bi-brightness-high-fill"></i>
                        <span class="ball "></span>
                    </label>
                </div>

                <!-- Logout -->
                <li class="nav-item">
                    <hr class="d-lg-none" />
                    <a class="nav-link d-lg-none text-danger" href="<?= BASEURL ?>">Logout</a>
                    <a class="btn btn-danger d-none d-lg-inline me-2" href="<?= BASEURL ?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <script src="<?= BASEURL ?>assets/js/header.js"></script>
</nav>