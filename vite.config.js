import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/modal.css',
                'resources/css/select2.min.css',
                'resources/css/select.css',
                'resources/js/app.js',
                'resources/js/scripts.js',
                'resources/js/jquery-3.7.0.min.js',
                'resources/js/jquery.maskedinput.js',
        //        'resources/js/select2.min.js',
                'resources/js/mask_phone.js',
            ],
            refresh: true,
        }),
    ],
});
