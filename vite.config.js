/*import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});*/
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',  // Permite conexiones desde cualquier dispositivo en la red
        port: 3000,        // El puerto en el que Vite se está ejecutando
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',  // Estilos SCSS o CSS
                'resources/js/app.js',      // Scripts JS
            ],
            refresh: true,
        }),
    ],
});

