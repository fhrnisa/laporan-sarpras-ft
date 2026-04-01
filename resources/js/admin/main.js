// main.js
import { api } from './utils/api.js';
import { initAdminPage } from './pages/admin.js';
import { initLaporanPage } from './pages/laporan.js';
import { initArsipPage } from './pages/arsip.js';

document.addEventListener('DOMContentLoaded', () => {
    const bodyClass = document.body.classList;
    
    // 1. Inisialisasi API Global sekali saja
    const config = window.appConfig || {};
    const baseUrl = config.apiUrl || 'http://localhost:8000/api';
    const csrfToken = config.csrfToken || '';
    api.init(baseUrl, csrfToken);

    // 2. Polisi Lalu Lintas (Routing)
    if (bodyClass.contains('admin-page')) {
        initAdminPage();
    } 
    else if (bodyClass.contains('laporan-page') || document.getElementById('kelolaBtn')) {
        initLaporanPage();
    } 
    else if (bodyClass.contains('arsip-page')) {
        initArsipPage();
    }
});