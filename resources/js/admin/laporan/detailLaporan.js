import { state } from "./state";

export async function loadReportDetail(id) {
    try {
            state.currentReportId = id;

            const detailLoading = document.getElementById('detailLoading');
            const detailContent = document.getElementById('detailContent');
            const detailError = document.getElementById('detailError');
            const detailActions = document.getElementById('detailActions');

            if (detailLoading) detailLoading.classList.remove('hidden');
            if (detailContent) detailContent.classList.add('hidden');
            if (detailError) detailError.classList.add('hidden');
            if (detailActions) detailActions.classList.add('hidden');

            const response = await fetch(`http://localhost:8001/api/admin/laporan/${id}`);
            const data = await response.json();

            if (data.success) {
                const report = data.data;
                displayReportDetail(report);
            } else {
                throw new Error(data.message || 'Gagal memuat detail');
            }
        } catch (error) {
            console.error('Error loading report detail:', error);
            const detailLoading = document.getElementById('detailLoading');
            const detailError = document.getElementById('detailError');
            const errorMessage = document.getElementById('errorMessage');

            if (detailLoading) detailLoading.classList.add('hidden');
            if (detailError) detailError.classList.remove('hidden');
            if (errorMessage) errorMessage.textContent = error.message;
        }

    }


export function displayReportDetail(report) {
    console.log(report);

        const detailLoading = document.getElementById('detailLoading');
        const detailContent = document.getElementById('detailContent');
        const detailActions = document.getElementById('detailActions');

        if (detailLoading) detailLoading.classList.add('hidden');
        if (detailContent) detailContent.classList.remove('hidden');
        if (detailActions) detailActions.classList.remove('hidden');

        // Set basic info
        const detailTitle = document.getElementById('detailTitle');
        const detailDate = document.getElementById('detailDate');
        const detailNama = document.getElementById('detailNama');
        const detailEmail = document.getElementById('detailEmail');
        const detailTelp = document.getElementById('detailTelp');
        const detailLokasi = document.getElementById('detailLokasi');
        const detailDeskripsi = document.getElementById('detailDeskripsi');
        const detailKode = document.getElementById("detailKodeLaporan");

        if (detailTitle) {
            detailTitle.textContent = `Detail Laporan`;
        }

        if (detailKode) {
            detailKode.textContent = report.kode_laporan || "-";
        }

if (report.created_at) {

    const date = new Date(report.created_at);

    detailDate.textContent =
        date.toLocaleDateString("id-ID", {
            weekday: "long",
            day: "numeric",
            month: "long",
            year: "numeric"
        }) +
        " • " +
        date.toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit"
        });

} else {

    detailDate.textContent = "-";

}
        if (detailNama) detailNama.textContent = report.nama_pengusul || '-';
        if (detailEmail) detailEmail.textContent = report.email || '-';
        if (detailTelp) detailTelp.textContent = report.nomor_telepon || '-';
        if (detailLokasi) detailLokasi.textContent = report.lokasi_kerusakan || '-';
        if (detailDeskripsi) detailDeskripsi.textContent = report.deskripsi_kerusakan || '-';

        // Set status
        const statusElement = document.getElementById('detailStatus');
        const status = report.status_laporan || 'menunggu';
        const STATUS_CONFIG = {
            menunggu: { text: 'Menunggu', class: 'bg-[#E1E7E9] text-[#022C55]' },
            diproses: { text: 'Diproses', class: 'bg-[#FEEF94] text-[#022C55]' },
            terselesaikan: { text: 'Terselesaikan', class: 'bg-[#A0F1B5] text-[#022C55]' },
            ditolak: { text: 'Ditolak', class: 'bg-[#FF7A7E] text-[#022C55]' }
        };

        const config = STATUS_CONFIG[status] || STATUS_CONFIG.menunggu;
        if (statusElement) {
            statusElement.textContent = config.text;
            statusElement.className = 'inline-flex px-3 py-1 text-sm font-semibold rounded-md ' + config.class;
        }

        // TAMPILKAN BUTTON SESUAI STATUS
        const actionButtonsContainer = document.getElementById('actionButtonsContainer');
        if (actionButtonsContainer) {
            actionButtonsContainer.innerHTML = '';

            switch(status) {
                case 'menunggu':
                    actionButtonsContainer.innerHTML = `
                        <button onclick="updateStatus('diproses')"
                                class="py-1 px-2 bg-[#FED43E] text-white rounded-md hover:bg-yellow-600 col-span-2">
                            Set Diproses
                        </button>
                    `;
                    break;

                case 'diproses':
                    actionButtonsContainer.innerHTML = `
                        <button onclick="updateStatus('terselesaikan')"
                                class="py-1 px-2 bg-[#00EA00] text-white rounded-md hover:bg-green-600">
                            Set Selesai
                        </button>
                        <button onclick="updateStatus('ditolak')"
                                class="py-1 px-2 bg-[#ED3237] text-white rounded-md hover:bg-red-600">
                            Tolak
                        </button>
                    `;
                    break;

                case 'ditolak':
                    actionButtonsContainer.innerHTML = `
                        <button onclick="updateStatus('menunggu')"
                                class="py-1 px-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 col-span-2">
                            Review Ulang
                        </button>
                    `;
                    break;

                case 'terselesaikan':
                    const detailActions = document.getElementById('detailActions');
                    if (detailActions) {
                        detailActions.classList.add('hidden');
                    }
                    break;
            }
        }

        // Set foto kerusakan
        const fotoElement = document.querySelector('#detailFotoContainer img');
        const noFotoMessage = document.getElementById('noFotoMessage');

        if (fotoElement && noFotoMessage) {

            if (report.foto_kerusakan) {

                const imageUrl = `http://localhost:8001/storage/${report.foto_kerusakan}`;

                fotoElement.src = imageUrl;
                fotoElement.style.display = "block";

                noFotoMessage.classList.add('hidden');

            } else {

                fotoElement.style.display = "none";
                noFotoMessage.classList.remove('hidden');

            }

        }

        // Set timestamps
        const detailCreatedAt = document.getElementById('detailCreatedAt');
        const detailUpdatedAt = document.getElementById('detailUpdatedAt');

        if (detailCreatedAt) {
            detailCreatedAt.textContent = report.created_at ?
                new Date(report.created_at).toLocaleString('id-ID') : '-';
        }
        if (detailUpdatedAt) {
            // Hanya tampilkan jika status bukan 'menunggu'
            if (status !== 'menunggu') {
                detailUpdatedAt.textContent = new Date(report.updated_at).toLocaleString('id-ID');
            } else {
                detailUpdatedAt.textContent = '-';
            }
        }

        // Show info boxes based on status
        const approvedInfo = document.getElementById('approvedInfo');
        const rejectedInfo = document.getElementById('rejectedInfo');
        const completedInfo = document.getElementById('completedInfo');

        // Hide all first
        if (approvedInfo) approvedInfo.classList.add('hidden');
        if (rejectedInfo) rejectedInfo.classList.add('hidden');
        if (completedInfo) completedInfo.classList.add('hidden');

        switch (status) {
            case 'diproses':
                if (approvedInfo) {
                    approvedInfo.classList.remove('hidden');
                    document.getElementById('detailDisetujuiOleh').textContent = report.disetujui_oleh || '-';
                    document.getElementById('detailWaktuDisetujui').textContent = report.disetujui_pada ?
                        new Date(report.disetujui_pada).toLocaleString('id-ID') : '-';
                }
                break;

            case 'ditolak':
                if (rejectedInfo) {
                    rejectedInfo.classList.remove('hidden');
                    document.getElementById('detailAlasan').textContent = report.alasan_ditolak || '-';
                    document.getElementById('detailWaktuDitolak').textContent = report.ditolak_pada ?
                        new Date(report.ditolak_pada).toLocaleString('id-ID') : '-';
                    document.getElementById('detailDitolakOleh').textContent = report.ditolak_oleh || '-';
                }
                break;

            case 'terselesaikan':
                if (completedInfo) {
                    completedInfo.classList.remove('hidden');
                    document.getElementById('detailDiselesaikanOleh').textContent = report.diselesaikan_oleh || '-';
                    document.getElementById('detailWaktuSelesai').textContent = report.diselesaikan_pada ?
                        new Date(report.diselesaikan_pada).toLocaleString('id-ID') : '-';

                    // Show completion proof
                    const buktiElement = document.getElementById('detailBukti');
                    const noBuktiMessage = document.getElementById('noBuktiMessage');
                    if (report.bukti_penyelesaian) {

                        const buktiUrl = report.bukti_penyelesaian.startsWith('http')
                            ? report.bukti_penyelesaian
                            : `http://localhost:8001/storage/${report.bukti_penyelesaian}`;

                        buktiElement.src = buktiUrl;

                        buktiElement.classList.remove('hidden');
                        noBuktiMessage.classList.add('hidden');

                    } else {

                        buktiElement.classList.add('hidden');
                        noBuktiMessage.classList.remove('hidden');

                    }
                }
                break;
        }
}