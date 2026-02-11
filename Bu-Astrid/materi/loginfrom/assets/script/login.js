// Ambil elemen-elemen penting dari DOM
const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register');
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');

// === Toggle antar form ===
// Saat klik "Sign-Up", tambahkan kelas 'active' → tampilkan form register
registerLink.onclick = () => {
    // Hapus pesan error login jika ada
    const oldError = loginForm.querySelector('.error-msg');
    if (oldError) oldError.remove();

    // Tampilkan form register
    wrapper.classList.add('active');
};

// Saat klik "Login", hapus kelas 'active' → kembali ke form login
loginLink.onclick = () => {
    wrapper.classList.remove('active');
};
