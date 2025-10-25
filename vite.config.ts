import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { PrimeVueResolver } from 'unplugin-vue-components/resolvers';
import Components from 'unplugin-vue-components/vite';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.ts',
            ssr: 'resources/js/ssr.ts',
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
        // Add this Components plugin
        Components({
            resolvers: [
                PrimeVueResolver(), // Automatically imports PrimeVue components
            ],
            dts: 'resources/js/components.d.ts', // Creates a TypeScript declaration file
        }),
    ],
});
