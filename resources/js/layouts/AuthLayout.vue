<script setup lang="ts">
import AppHead from '@/components/AppHead.vue';
import LocaleSelector from '@/components/LocaleSelector.vue';

defineProps<{
    title?: string;
    description?: string;
}>();

</script>

<template>
    <AppHead :title="$t('Вход')"></AppHead>
    <section class="container">
        <div class="page-auth-form">
            <LocaleSelector logo="ruby"/>
            <slot />
        </div>
    </section>
</template>
