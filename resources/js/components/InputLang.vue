<script setup lang="ts">
import { useLangState } from '@/stores/useLangStore.js';

const lang = useLangState();
const props = defineProps<{
    placeholder: string,
    ru : string,
    ua : string,
}>();

const emits = defineEmits<{
    (e: 'update:ru', payload: string | number): void;
    (e: 'update:ua', payload: string | number): void;
    (e: 'clear-error'): void;
}>();
const handleInputRu = (e) => {
    emits('clear-error');
    emits('update:ru', e.target.value);
};
const handleInputUa = (e) => {
    emits('clear-error');
    emits('update:ua', e.target.value);
};


</script>

<template>
    <input
        class="input-lang"
        v-if = "lang.locale === 'ru'"
        :value="ru"
        :placeholder=placeholder
        @input="handleInputRu"
    >
    <input
        class="input-lang"
        v-if = "lang.locale === 'ua'"
        :value="ua"
        :placeholder=placeholder
        @input="handleInputUa"
    >
</template>
