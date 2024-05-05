import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {copy} from "vite-plugin-copy";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        copy({
                assets: [
                    {
                        from: 'vendor/tinymce/tinymce',
                        to: 'public/js/tinymce'
                    },
                ]
            }
        )
    ],
});
