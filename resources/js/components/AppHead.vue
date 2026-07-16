<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps({ title: String })
</script>

<template>
    <Head :title="title ? `${title} - ${$t('Ruby')}` : $t('Ruby')">
        <slot />
    </Head>
</template>

<style scoped lang="scss">

</style>
