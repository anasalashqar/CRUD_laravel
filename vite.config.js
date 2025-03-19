import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/js/app.js',
                'public/admin_template/startbootstrap-sb-admin-2-gh-pages/scss/sb-admin-2.scss',
                'public/admin_template/startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
     resolve: {
        alias: {
            'bootstrap': 'bootstrap',
        }
    },
});
