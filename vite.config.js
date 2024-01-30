import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            /**
             * Recursos a procesar/compilar
            */
            input: [
                //Bootstrap
                'resources/css/bootstrap.scss',
                'resources/js/bootstrap.js',

                //Tailwind
                'resources/css/tailwind.css',

                //Font-Awesome
                'resources/js/font-awesome.js',

                //Recursos App/Resources
                'resources/js/app.js',

                //Recursos App/Public
                'public/resources/css/app.css',
            ],
            refresh: true,
        }),
    ],
    build: {
        chunkSizeWarningLimit: 1600
    }
});
