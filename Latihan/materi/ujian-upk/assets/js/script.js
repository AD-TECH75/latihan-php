function login() {
    // setting email dan password
    let email = 'admin@gmail.com';
    let password = 'admin';

    // mengambil email dan password dari input
    let formEmail = document.getElementById('email').value;
    let formPassword = document.getElementById('password').value;

    // mengambil id error
    let error = document.getElementById('error');

    // verifikasi email dan password
    if (formEmail == email && formPassword == password) {
        error.style.display = "none"; // memastikan masih kosong
        window.location = 'private/dashboard.php'; // pindah halaman
        return false; // mencegah reload
    } else {
        error.innerHTML = "Email atau Password Salah";
        error.style.display = "block"; // mernampilkan pesan
        return false; //mencegah reload
    }
}