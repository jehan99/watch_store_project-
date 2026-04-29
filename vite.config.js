import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
<<<<<<< HEAD
            input: ['resources/css/App.css',

                'resources/js/app.js',
                'resources/js/admin.js'
                // 'resources/css/userRegStyles.css'
=======
            input: [
                'resources/css/App.css',
                'resources/js/app.js'

>>>>>>> 1f8edfc (added the logo)



            ],
            refresh: true,
        }),
    ],
});
