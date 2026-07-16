<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';
import AppHead from '@/components/AppHead.vue';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import { useLangState } from '@/stores/useLangStore.js';
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { onMounted, useTemplateRef } from 'vue';
import LocaleSelector from '@/components/LocaleSelector.vue';

const page = usePage();
const handleLogout = () => {
    router.flushAll();
};
const store = useLangState();
const selectLocale = (code: string) => {
    loadLanguageAsync(code);
    store.locale = code;
};
const wpUrl: string = import.meta.env.VITE_WP_APP_URL;

</script>

<template>
    <AppHead :title="$t('Dashboard')"></AppHead>
    <header>
        <div class="container">
            <LocaleSelector logo="ruby"/>
        </div>
    </header>
    <main>
        <div class="container">
            <div ref="mob-sidebar" class="sidebar-panel">
                <Link
                    :href="edit()"
                    :tabindex="1"
                    as="button"
                >
                    <svg>
                        <use :xlink:href="`/__spritemap#sprite-user`"></use>
                    </svg>
                    <span>{{ $t('Профиль') }}</span>
                </Link>
                <Link
                    v-if="$page.props.auth.user"
                    :href="logout()"
                    @click="handleLogout"
                    :tabindex="5"
                >
                    {{ $t('Выйти') }}
                </Link>
            </div>
            <div class="content">
                <slot lang=""/>
            </div>
        </div>
    </main>
</template>

<style lang="scss" scoped>
@use '../../scss/_variables.scss' as *;
@use '../../scss/_typography.scss' as *;
@use '../../scss/_mixins.scss' as *;
header {
    position: sticky;
    top: 0;
    padding-top: 6px;
    z-index: 3;
    background: $white;
    @media all and (max-width: $widthPad) {
        padding-top: 4px;
    }
    .locale-selector {
        display: grid;
        grid-template-columns: 1fr 1fr;
        justify-content: space-between;
        margin-bottom: 10px;
        padding: 8px 24px;
        align-items: center;
        grid-column-start: span 2;
        border: none;
        box-shadow: 2px 3px 3px #677183;
        background: linear-gradient(
            90deg,
            rgba(#0c489f, 1) 0%,
            rgba($deepblue, 0.7) 25%,
            rgba($blue, 0.8) 50%,
            rgba($deepblue, 0.7) 75%,
            rgba(#0c489f, 1) 100%
        );
        border-radius: 6px;
        color: $white;
        @media all and (max-width: $widthPad) {
            margin-left: -$mobileMargin;
            margin-right: -$mobileMargin;
            margin-bottom: 0;
            padding: 6px 12px;
            grid-template-columns: 1fr auto auto;
            gap: 16px;
            background: linear-gradient(
                    90deg,
                    rgba(#0c489f, 1) 0%,
                    rgba($deepblue, 0.8) 40%,
                    rgba($deepblue, 0.8) 60%,
                    rgba(#0c489f, 0.9) 100%
            );
        }
        img {
            display: block;
            height: 44px;
            @media all and (max-width: $widthPad) {
                height: 36px;
            }
            @media all and (max-width: $widthMob) {
                height: 32px;
            }
        }
    }
}
main {
    .container {
        position: relative;
        display: grid;
        grid-template-columns: 248px 1fr;
        align-items: start;
        gap: 24px;
        margin-top: 16px;
        @media all and (max-width: $widthLarge) {
            grid-template-columns: 212px 1fr;
        }
        @media all and (max-width: $widthPad) {
            grid-template-columns: 1fr;
        }
        .sidebar-panel {
            display: flex;
            box-sizing: border-box;
            flex-direction: column;
            gap: 24px;
            padding: 32px;
            border-radius: 6px;
            box-shadow: 2px 3px 3px #677183;
            background: linear-gradient(
                    90deg,
                    rgba(#0c489f, 1) 0%,
                    rgba($deepblue, 0.8) 100%,
            );
            @media all and (max-width: $widthPad) {
                display: none;
                padding: 0;
            }
            span {
                color: $white;
                text-align: center;
            }
            button {
                padding: 0;
                background: transparent;
                @extend .font-h4;
                color: $white;
                text-align: center;
                cursor: pointer;
                @include icon($white, 28px);
                @include flex-with-padding(12px);
                justify-content: center;
                svg{
                    flex: 0 0 auto;
                }
            }
        }
        .content {
            height: calc(100vh - 76px);
        }

    }
}
</style>
