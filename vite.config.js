import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/yandex_maps.js',
                'resources/js/fancybox.js'
            ],
            refresh: true,
        })
    ],
    server: {
        host: "192.168.56.56",
        watch: {
            usePolling: true,
        },
    }
});
