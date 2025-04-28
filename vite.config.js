import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import svgLoader from 'vite-svg-loader'

export default defineConfig({
    ssr: {
        noExternal: [
            'vue-mention',
            'floating-vue'
        ]
    },
    plugins: [
        svgLoader({
            svgo: false
        }),
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        watch: {
            usePolling: true,
        },
        origin: 'http://localhost:5173',
    },
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});
