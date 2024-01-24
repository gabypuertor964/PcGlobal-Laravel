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

                //Recursos App/Nativos
                'public/resources/css/app.css', 
                'public/resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        chunkSizeWarningLimit: 1600
    }
});
