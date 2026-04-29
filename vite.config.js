import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/App.css',

                'resources/js/app.js',
                'resources/js/admin.js'
                // 'resources/css/userRegStyles.css'



            ],
            refresh: true,
        }),
    ],
});
