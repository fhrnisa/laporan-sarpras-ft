document.addEventListener("DOMContentLoaded", function () {

    const openBtn = document.getElementById("openNotification");
    const closeBtn = document.getElementById("closeNotification");
    const panel = document.getElementById("notificationPanel");

    if (!openBtn || !closeBtn || !panel) return;

    // Buka panel
    openBtn.addEventListener("click", () => {
        panel.classList.remove("hidden");
    });

    // Tutup panel via tombol ×
    closeBtn.addEventListener("click", () => {
        panel.classList.add("hidden");
    });

    // Klik area hitam = tutup panel
    panel.addEventListener("click", (e) => {
        if (e.target === panel) {
            panel.classList.add("hidden");
        }
    });
});
