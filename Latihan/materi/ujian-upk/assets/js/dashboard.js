document.addEventListener("DOMContentLoaded", function () {
	const alertBox = document.querySelector(".auto-hide");

	if (alertBox) {
		// Hilang setelah 3 detik
		setTimeout(() => {
			alertBox.style.opacity = "0";
			alertBox.style.transition = "opacity 0.5s ease";

			// Hapus elemen dan hapus URL GET
			setTimeout(() => {
				alertBox.remove();

				// Hapus semua query ?error=.. atau ?success=..
				const url = new URL(window.location);
				url.search = ""; // hapus seluruh query string
				window.history.replaceState({}, "", url);
			}, 500);
		}, 3000);
	}
});
