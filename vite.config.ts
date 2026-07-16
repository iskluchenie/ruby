import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import i18n from 'laravel-vue-i18n/vite';
import VitePluginSvgSpritemap from '@spiriit/vite-plugin-svg-spritemap';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/app.scss', 'resources/js/app.ts'],
            refresh: true,
        }),
        inertia({
            ssr: false
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        i18n(),
        wayfinder({
            formVariants: true,
        }),
        VitePluginSvgSpritemap(['resources/svg/*.svg'] as any, {
            svgo: {
                plugins: [
                    {
                        name: 'convertColors',
                        params: {
                            currentColor: /fill/i,
                        },
                    },
                    'removeTitle',
                    'removeXMLNS',
                ],
            } as any,
        })
    ],
    build: {
        rollupOptions: {
            onwarn(warning, warn) {
                if (warning.code === 'INVALID_ANNOTATION') return
                warn(warning)
            }
        }
    } as any
});
