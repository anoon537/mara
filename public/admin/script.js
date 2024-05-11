// Elemen tombol untuk membuka/tutup sidebar
const hamBurger = document.querySelector(".toggle-btn");

// Elemen sidebar yang akan diubah
const sidebar = document.querySelector("#sidebar");

// Baca status dari Local Storage saat halaman dimuat
const sidebarStatus = localStorage.getItem("sidebarStatus"); // Ambil status dari Local Storage

// Jika status adalah 'open', pastikan sidebar terbuka
if (sidebarStatus === "open") {
    sidebar.classList.add("expand"); // Tambahkan kelas 'expand'
}

// Jika sidebar dalam keadaan terbuka, ubah ikon
function updateIcon() {
    const icon = hamBurger.querySelector("i"); // Ambil elemen ikon
    if (sidebar.classList.contains("expand")) {
        icon.classList.remove("fa-solid", "fa-bars");
        icon.classList.add("fas", "fa-bars-staggered"); // Pastikan penamaan kelas sesuai
    } else {
        icon.classList.remove("fas", "fa-bars-staggered");
        icon.classList.add("fa-solid", "fa-bars");
    }
}

// Setiap kali tombol ditekan, toggle status sidebar dan simpan di Local Storage
hamBurger.addEventListener("click", function () {
    sidebar.classList.toggle("expand"); // Toggle sidebar

    if (sidebar.classList.contains("expand")) {
        localStorage.setItem("sidebarStatus", "open"); // Simpan status 'open' di Local Storage
    } else {
        localStorage.setItem("sidebarStatus", "closed"); // Simpan status 'closed'
    }

    updateIcon(); // Ubah ikon sesuai status baru
});

// Ubah ikon saat halaman dimuat untuk mencocokkan status sidebar
updateIcon();

window.addEventListener("load", () => {
    const loadingOverlay = document.getElementById("loading-overlay");
    const mainContent = document.getElementById("main-content");

    // Hilangkan overlay dengan animasi
    loadingOverlay.style.opacity = "0";
    setTimeout(() => {
        loadingOverlay.style.display = "none"; // Sembunyikan overlay setelah animasi selesai
    }, 500); // Waktu transisi (500ms)

    // Tampilkan konten utama dengan animasi
    mainContent.style.display = "block";
    mainContent.style.opacity = "1"; // Membuat konten muncul perlahan
});
