import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true, // Useful in development mode
        }),
    ],
    build: {
        outDir: 'public/build', // Ensures files are placed in the right directory
        manifest: true,         // Generates a manifest.json for proper asset mapping
        rollupOptions: {
            input: {
                app: 'resources/js/app.js', // Adjust to include all necessary entry points
            },
        },
    },
    base: '/build/', // Base path for serving built files
});
