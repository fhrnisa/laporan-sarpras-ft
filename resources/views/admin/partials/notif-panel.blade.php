<!-- === MODAL DETAIL LAPORAN === -->
<div id="notifOverlay" class="fixed inset-0 bg-black/40 z-50">
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-xl rounded-l-xl overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-start p-5 border-b">
            <div>
                <h2 id="detailTitle" class="text-3xl font-semibold text-[#002C55]">Notifikasi</h2>
                <p id="detailDate" class="text-lg text-[#002C55]">... Pesan Baru</p>
            </div>
            <button id="closeNotif" class="text-gray-500 hover:text-gray-700">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.00098 5L19 18.9991" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.99996 18.9991L18.999 5" stroke="#002C55" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="p-5 space-y-5 text-sm text-[#002C55]">

            <div class="grid grid-rows-2">
                <div class="flex justify-between">
                    <p class="text-lg text-[#002C55] font-semibold">1 Laporan Baru Masuk</p>
                    <p class="text-lg text-[#ED3237]">*</p>
                </div>
                <div>
                    <p class="text-base text-[#002C55]">Nama Pengsul: Sang Bimo Raharjoning Leksono</p>
                </div>
            </div>

            <div class="grid grid-rows-2">
                <div class="flex justify-between">
                    <p class="text-lg text-[#002C55] font-semibold">1 Laporan Baru Masuk</p>
                    <p class="text-lg text-[#ED3237]">*</p>
                </div>
                <div>
                    <p class="text-base text-[#002C55]">Nama Pengsul: Fahrunnisa Kusumawardani</p>
                </div>
            </div>
           
                        <div class="grid grid-rows-2">
                <div class="flex justify-between">
                    <p class="text-lg text-[#002C55] font-semibold">1 Laporan Baru Masuk</p>
                    <p class="text-lg text-[#ED3237]">*</p>
                </div>
                <div>
                    <p class="text-base text-[#002C55]">Nama Pengsul: Sang Bimo Raharjoning Leksono</p>
                </div>
            </div>

            <div class="grid grid-rows-2">
                <div class="flex justify-between">
                    <p class="text-lg text-[#002C55] font-semibold">Admin 123 Mengubah Status Laporan</p>
                    <p class="text-lg text-[#ED3237]">*</p>
                </div>
                <div>
                    <p class="text-base text-[#002C55]">Laporan #2</p>
                </div>
            </div>

            <div class="grid grid-rows-2">
                <div class="flex justify-between">
                    <p class="text-lg text-[#002C55] font-semibold">1 Laporan Baru Masuk</p>
                    <p class="text-lg text-[#ED3237]">*</p>
                </div>
                <div>
                    <p class="text-base text-[#002C55]">Nama Pengsul: Fahrunnisa Kusumawardani</p>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="p-5">
            <button id="readBtn" class="w-full py-2 bg-[#002C5F] text-white rounded-md hover:bg-[#01408C]">
                Tandai Dibaca
            </button>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById("notifOverlay");
    const openBtn = document.getElementById("openNotifBtn");
    const closeBtn = document.getElementById("closeNotif");

    // Buka modal
    openBtn.addEventListener("click", () => {
        overlay.classList.remove("hidden");
    });

    // Tutup modal
    closeBtn.addEventListener("click", () => {
        overlay.classList.add("hidden");
    });

    // Klik di luar → tutup
    overlay.addEventListener("click", (e) => {
        if (e.target === overlay) {
            overlay.classList.add("hidden");
        }
    });
});
</script>
