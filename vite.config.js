import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
    build: {
        manifest: true,
    },
    resolve: {
        alias: [
            {
                find: '@/',
                replacement: path.resolve(__dirname, './resources/ts')
            }
        ]
    },
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    // includeAbsolute: false,
                },
            },
        }),
        laravel([
            'resources/ts/app.ts',
        ]),
    ],
});
