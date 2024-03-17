import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            /**
             * Recursos a procesar/compilar
             */
            input: [
                //Bootstrap
                "resources/css/bootstrap.scss",
                "resources/js/bootstrap.js",

                //Tailwind
                "resources/css/tailwind.css",

                //Font-Awesome
                "resources/js/font-awesome.js",

                //Recursos Nativos de la App
                "resources/css/admin.css",
                "resources/js/search.js",
                "resources/js/invoices-search.js",
                "resources/js/active-invoices-search.js",
                "resources/js/active-invoices-search-edit.js",
                "resources/css/app.css",
                "resources/js/navbar.js",
                "resources/js/scroll.js",
                "resources/js/select_preview.js",
            ],
            refresh: true,
        }),
    ],
    build: {
        //Aumentar el limite de tamaño de los archivos
        chunkSizeWarningLimit: 1600,
    },
});
