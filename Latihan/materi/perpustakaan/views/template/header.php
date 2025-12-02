<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
$role = isset($_SESSION["role"]) ? $_SESSION["role"] : null;

// menentukan nama yang di display
$displayname = $username ? $username : "Guest";

// mengambil nama file halaman saat ini
$currentPage = basename($_SERVER["SCRIPT_NAME"]);
?>

<style>
    header {
        background-color: var(--bs-light);
    }

    .tombol {
        background-color: var(--bs-secondary) !important;
    }

    .checkbox {
        opacity: 0;
        position: absolute;
        display: none !important;
    }

    .checkbox-label {
        background-color: var(--bs-primary);
        width: 50px;
        height: 26px;
        border-radius: 50px;
        position: relative;
        padding: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center
    }

    .bi-moon-fill {
        color: #f1c40f;
    }

    .bi-brightness-high-fill {
        color: #f39c12;
    }

    .checkbox-label .ball {
        background-color: var(--bs-light);
        width: 22px;
        height: 22px;
        position: absolute;
        left: 2px;
        top: 2px;
        border-radius: 50%;
        transition: transform .2s linear;
    }

    .checkbox:checked+.checkbox-label .ball {
        transform: translateX(24px);
    }

    #checkbox {
        display: none;
    }

    [data-bs-theme="light"] {
        body {
            background-color: #d6d6d6ff;
        }
    }

    [data-bs-theme="dark"] {
        header {
            background-color: var(--bs-secondary);
        }

        .tombol {
            background-color: var(--bs-light) !important;
        }

        .ball {
            background-color: white;
        }
    }
</style>

<div class="header d-flex p-4" style="width: 100%; height: 80px; max-height: 80px;">
    <!-- bagian kiri -->
    <div class="left d-flex d-inline align-items-center float-start">
        <i class="bi bi-book justify-content-center mb-1" style="font-size: 50px;"></i>
        <h1 class="text-uppercase fs-3 justify-content-center align-item-center" style="margin-left: 10px;"><a
                href="<?= BASEURL ?>" class="text-decoration-none text-reset">my-library</a></h1>
    </div>

    <!-- bagian kanan -->
    <div class="right dropdown-center ms-auto d-flex align-items-center justify-content-center"
        data-bs-auto-close="false">

        <!-- toggle ganti tema -->
        <div class="row justify-content-center me-3">
            <input type="checkbox" class="checkbox" id="checkbox">
            <label for="checkbox" class="checkbox-label bg-gradient">
                <i class="bi bi-moon-fill"></i>
                <i class="bi bi-brightness-high-fill"></i>
                <span class="ball "></span>
            </label>
        </div>

        <!-- tombol Profile -->
        <button class="tombol btn rounded-circle p-1" type="button" data-bs-toggle="dropdown">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjCX5TOKkOk3MBt8V-f8PbmGrdLHCi4BoUOs_yuZ1pekOp8U_yWcf40t66JZ4_e_JYpRTOVCl0m8ozEpLrs9Ip2Cm7kQz4fUnUFh8Jcv8fMFfPbfbyWEEKne0S9e_U6fWEmcz0oihuJM6sP1cGFqdJZbLjaEQnGdgJvcxctqhMbNw632OKuAMBMwL86/w640-h596/pp%20kosong%20wa%20default.jpg"
                alt="Profile Picture" width="35px" height="35px" class="rounded-circle">
        </button>

        <!-- dropdown menu -->
        <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 220px;">
            <div class="text-center mb-2">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjCX5TOKkOk3MBt8V-f8PbmGrdLHCi4BoUOs_yuZ1pekOp8U_yWcf40t66JZ4_e_JYpRTOVCl0m8ozEpLrs9Ip2Cm7kQz4fUnUFh8Jcv8fMFfPbfbyWEEKne0S9e_U6fWEmcz0oihuJM6sP1cGFqdJZbLjaEQnGdgJvcxctqhMbNw632OKuAMBMwL86/w640-h596/pp%20kosong%20wa%20default.jpg"
                    alt="Profile Picture" width="70px" height="70px" class="rounded-circle">
            </div>

            <p class="text-center fw-bold mb-2"><?= $displayname ?></p>

            <hr>
            <li><a href="<?= BASEURL ?>" class="dropdown-item">Beranda</a></li>

            <!-- jika belum login maka akan muncul -->
            <?php if (!$username): ?>
                <hr>
                <li><a href="<?= BASEURL ?>auth/login.php" class="dropdown-item">Login/register</a></li>
            <?php endif; ?>

            <?php if ($role == "admin"): ?>
                <hr>
                <li><a href="<?= BASEURL ?>private/admin.php" class="dropdown-item">Halaman Admin</a></li>
                <hr>
                <a href="<?= BASEURL ?>private/kelolaUser.php" class="dropdown-item">Kelola User</a>
            <?php endif; ?>
            <?php if ($role == "user"): ?>
                <hr>
                <li><a href="<?= BASEURL ?>public/user.php" class="dropdown-item">Halaman User</a></li>
            <?php endif; ?>
            <?php if ($role == "pengarang"): ?>
                <hr>
                <li><a href="<?= BASEURL ?>public/pengarang.php" class="dropdown-item">Halaman Pengarang</a></li>
            <?php endif; ?>

            <?php if ($username): ?>
                <hr>
                <li><a href="<?= BASEURL ?>auth/logout.php" class="dropdown-item text-danger">Logout</a></li>
            <?php endif ?>
        </ul>
    </div>
</div>

<script>
    const html = document.getElementById("htmlpage");
    const checkbox = document.getElementById("checkbox");
    checkbox.addEventListener("change", () => {
        if (checkbox.checked) {
            html.setAttribute("data-bs-theme", "dark");
        } else {
            html.setAttribute("data-bs-theme", "light");
        }
    })
</script>