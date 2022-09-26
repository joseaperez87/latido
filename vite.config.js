// vite.config.js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

import { resolve, dirname } from 'node:path'
import { fileURLToPath } from 'url'
import vueI18n from '@intlify/vite-plugin-vue-i18n'

export default defineConfig({
    plugins: [
        vue(),
        vueI18n({
            include: resolve(dirname(fileURLToPath(import.meta.url)), './resources/js/i18n/locales/**')
        }),
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});
