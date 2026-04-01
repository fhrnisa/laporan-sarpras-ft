import { loadReportDetail } from "./detailLaporan";
import { openDetailModal } from "./modals";

document.addEventListener("click", function (e) {

    const btn = e.target.closest(".aksiBtn");
    if (!btn) return;

    const id = btn.dataset.id;
    openDetailModal();
    loadReportDetail(id);

});