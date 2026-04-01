import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/admin/main.js',
                'resources/js/admin/pages/laporan.js',
                'resources/js/admin/pages/arsip.js',
                'resources/js/admin/pages/admin.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
