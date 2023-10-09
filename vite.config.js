import { defineConfig, normalizePath, build } from 'vite'
import laravel from 'laravel-vite-plugin';
import path, { resolve } from 'path'
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/themes/dark/app-dark.scss',
                'resources/js/app.js',
                'resources/js/script.js',
                'resources/scss/bootstrap.scss',
                'resources/scss/styles.scss'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': normalizePath(resolve(__dirname, 'src/resources')),
            '~bootstrap': resolve(__dirname, 'node_modules/bootstrap'),
            '~bootstrap-icons': resolve(__dirname, 'node_modules/bootstrap-icons'),
            '~perfect-scrollbar': resolve(__dirname, 'node_modules/perfect-scrollbar'),
            '~@fontsource': resolve(__dirname, 'node_modules/@fontsource'),
            '~select2': resolve(__dirname, 'node_modules/select2')
        }
    },
});
