import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
<<<<<<< HEAD
=======
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
});
