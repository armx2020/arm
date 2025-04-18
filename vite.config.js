import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/select.css',
                'resources/js/app.js',
                'resources/js/scripts.js',
                'resources/js/mask_phone.js',
            ],
            refresh: true,
        }),
    ],
});
