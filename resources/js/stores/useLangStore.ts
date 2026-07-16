import { getActiveLanguage } from 'laravel-vue-i18n';
import { defineStore } from 'pinia';
import { ref } from 'vue';


export const useLangState = defineStore('lang', () => {
    const locale = ref(getActiveLanguage());
    function translate(rawString: string) {
        if (!rawString) return ''
        const pattern = `\\[:${locale.value}\\](.*?)(?=\\[:|$)`;
        const regex = RegExp(pattern, 's');
        const match = rawString.match(regex);
        if (match && match[1]) {
            return match[1].trim();
        }
        const anyLangRegex = /\[:\w+\](.*?)(?=\[:|$)/s;
        const fallbackMatch = rawString.match(anyLangRegex);
        return fallbackMatch ? fallbackMatch[1].trim() : rawString;
    }
    return { locale, translate};
});
