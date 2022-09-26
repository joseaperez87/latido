import { createI18n } from 'vue-i18n'
/*
 * The i18n resources in the path specified in the plugin `include` option can be read
 * as vue-i18n optimized locale messages using the import syntax
 */
import messages from '@intlify/vite-plugin-vue-i18n/messages'
import { useCookies } from "vue3-cookies";
const { cookies } = useCookies();
const locale = cookies.get('lang') ? cookies.get('lang') : 'en';

const i18n = createI18n({
  locale: locale,
  messages
})

export  default i18n;
