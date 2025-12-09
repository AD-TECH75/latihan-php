// 1. Ambil elemen
const html = document.getElementById("htmlpage");
const checkbox = document.getElementById("checkbox");

// 2. Fungsi untuk menerapkan tema
function applyTheme(isDark) {
	if (isDark) {
		html.setAttribute("data-bs-theme", "dark");
		checkbox.checked = true;
	} else {
		html.setAttribute("data-bs-theme", "light");
		checkbox.checked = false;
	}
}

// 3. Saat halaman dimuat: cek localStorage
document.addEventListener("DOMContentLoaded", () => {
	const savedTheme = localStorage.getItem("theme");
	const isDark = savedTheme === "dark";
	applyTheme(isDark);
});

// 4. Saat toggle: simpan ke localStorage
checkbox.addEventListener("change", () => {
	const isDark = checkbox.checked;
	applyTheme(isDark);
	localStorage.setItem("theme", isDark ? "dark" : "light");
});
