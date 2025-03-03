import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    // server:{
    //     hmr: {
    //         host: 'lms-version2.ddev.site',
    //     }
    // },
    server:{
        host:'127.0.0.1',
        port: '32807'
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        })
    ],
});
