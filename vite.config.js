import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/boostrap.css',
                'resources/js/boostrap.js',
                'public/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
