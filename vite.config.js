import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [

                //Compilacion Recursos Bootstrap
                'resources/css/bootstrap.scss',
                'resources/js/bootstrap.js',

                //Compilacion Recursos App/Nativos
                'resources/css/app.css', 
                'public/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
