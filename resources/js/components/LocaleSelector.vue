<script setup lang="ts">
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { useLangState } from '@/stores/useLangStore.js';
import { useTemplateRef } from 'vue';

const store = useLangState();

defineProps<{
    logo: string;
}>();
const selectLocale = (code: string) => {
    loadLanguageAsync(code);
    store.locale = code;
};

const mobSidebar = useTemplateRef('mob-sidebar')

const toggleMobMenu = () => {
    if (mobSidebar.value.classList.contains('collapsing')) {
        return
    }
    if (mobSidebar.value.style.display === 'flex'){
        mobSidebar.value.style.height = `${mobSidebar.value.offsetHeight}px`
        mobSidebar.value.offsetHeight
        mobSidebar.value.style.display = 'flex'
        mobSidebar.value.style.height = 0
        mobSidebar.value.style.overflow = 'hidden'
        mobSidebar.value.style.transition = `height 270ms ease`
        mobSidebar.value.classList.add('collapsing')
        window.setTimeout(() => {
            mobSidebar.value.classList.remove('collapsing')
            mobSidebar.value.style.display = ''
            mobSidebar.value.style.height = ''
            mobSidebar.value.style.transition = ''
            mobSidebar.value.style.overflow = ''
        }, 350)
    } else{
        mobSidebar.value.style.display = 'flex'
        const height = mobSidebar.value.offsetHeight
        mobSidebar.value.style.height = 0
        mobSidebar.value.style.overflow = 'hidden'
        mobSidebar.value.style.transition = `height 270ms ease`
        mobSidebar.value.classList.add('collapsing')
        mobSidebar.value.offsetHeight
        mobSidebar.value.style.height = `${height}px`
        window.setTimeout(() => {
            mobSidebar.value.classList.remove('collapsing')
            mobSidebar.value.style.height = ''
            mobSidebar.value.style.transition = ''
            mobSidebar.value.style.overflow = ''
        }, 270)
    }
}

</script>

<template>
    <div class="locale-selector">
        <ul class="language">
            <li
                :class="{ 'active-language': store.locale === 'ru' }"
                @click="selectLocale('ru')"
            >
                <div>RU</div>
            </li>
            <li
                :class="{ 'active-language': store.locale === 'ua' }"
                @click="selectLocale('ua')"
            >
                <div>UA</div>
            </li>
            <li
                :class="{ 'active-language': store.locale === 'en' }"
                @click="selectLocale('en')"
            >
                <div>EN</div>
            </li>
        </ul>
        <button class="button-menu mob-only" title="Menu" @click="toggleMobMenu">
            <svg>
                <use :xlink:href="`/__spritemap#sprite-menu`"></use>
            </svg>
        </button>
    </div>
</template>

<style lang="scss" scoped>
@use '../../scss/_variables.scss' as *;
@use '../../scss/_typography.scss' as *;
.locale-selector {
    display: flex;
    justify-content: space-between;
    align-items: end;
    border-bottom: solid 2px $ruby;
    padding: 0 16px 8px 16px;
    &.low-height {
        img {
            height: 44px;
            @media all and (max-width: $widthPad) {
                height: 36px;
            }
            @media all and (max-width: $widthMob) {
                height: 32px;
            }
        }
    }
    img {
        display: block;
        height: 50px;
        object-fit: contain;
        @media all and (max-width: $widthPad) {
            height: 44px;
        }
        @media all and (max-width: $widthMob) {
            height: 36px;
        }
    }
}
</style>
