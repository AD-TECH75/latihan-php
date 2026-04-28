<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <!-- Menghubungkan file CSS untuk styling halaman -->
    <link rel="stylesheet" href="<?php BASE_URL ?>assets/style/login.css" />
    <!-- Menggunakan ikon dari Boxicons (library ikon gratis) -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Wrapper utama: wadah seluruh konten login & register -->
    <div class="wrapper">
        <!-- Elemen latar belakang animasi (dekoratif) -->
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

        <!-- Form Login (muncul pertama kali) -->
        <div class="form-box login">
            <h2 class="animation" style="--i: 0; --j: 21">Login</h2>
            <form id="loginForm" action="<?= BASE_URL ?>app/login.php" method="post">
                <!-- Input username -->
                <div class="input-box animation" style="--i: 1; --j: 22">
                    <input type="text" id="username" name="username" required />
                    <label>username</label>
                    <i class="bx bx-user"></i> <!-- Ikon user dari Boxicons -->
                </div>

                <!-- Input password -->
                <div class="input-box animation" style="--i: 2; --j: 23">
                    <input type="password" id="password" name="password" required />
                    <label>password</label>
                    <i class="bx bx-lock"></i> <!-- Ikon kunci -->
                </div>

                <!-- Tombol submit login -->
                <button type="submit" class="btn animation" style="--i: 3; --j: 24">Login</button>

                <!-- Link ke halaman register (akan muncul form register) -->
                <div class="loreg-link animation" style="--i: 4; --j: 25">
                    <p>Don't have an account? <a href="#" class="register">Sign-Up</a></p>
                </div>
                <!-- Pesan error akan disisipkan DI SINI saat login gagal -->
            </form>
        </div>

        <!-- Teks info di sisi kanan (saat login aktif) -->
        <div class="info-text login">
            <h2 class="animation" style="--i: 0; --j: 20">Welcome Back!</h2>
            <p class="animation" style="--i: 1; --j: 21">Login untuk mengakses sistem.</p>
        </div>

        <!-- Form Register (tersembunyi awalnya, muncul saat klik Sign-Up) -->
        <div class="form-box register">
            <h2 class="animation" style="--i: 17; --j: 0">Sign Up</h2>
            <form id="registerForm" action="<?= BASE_URL ?>app/register.php" method="post">
                <div class="input-box animation" style="--i: 18; --j: 1">
                    <input type="text" name="username" required />
                    <label>username</label>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box animation" style="--i: 19; --j: 2">
                    <input type="email" name="email" required />
                    <label>email</label>
                    <i class="bx bx-envelope"></i> <!-- Ikon email -->
                </div>
                <div class="input-box animation" style="--i: 20; --j: 3">
                    <input type="password" name="password" required />
                    <label>password</label>
                    <i class="bx bx-lock"></i>
                </div>
                <button type="submit" class="btn animation" style="--i: 21; --j: 4">Sign Up</button>
                <div class="loreg-link animation" style="--i: 22; --j: 5">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>

        <!-- Teks info di sisi kiri (saat register aktif) -->
        <div class="info-text register">
            <h2 class="animation" style="--i: 17; --j: 0">Join Us!</h2>
            <p class="animation" style="--i: 18; --j: 1">Daftar hanya untuk tampilan.</p>
        </div>
    </div>

    <!-- Menghubungkan file JavaScript untuk logika interaksi -->
    <script src="<?php BASE_PATH ?>assets/script/login.js"></script>
</body>

</html>