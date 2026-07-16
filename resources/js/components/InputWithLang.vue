<script setup lang="ts">
import { Label } from '@/components/ui/label/index.js';
import { translate } from '@/lib/utils.js';
import InputLang from '@/components/InputLang.vue';
import { ref } from 'vue';
import { wTrans } from 'laravel-vue-i18n';

const props = defineProps<{
    name: string;
    type: string;
    tabindex: string;
    label: string;
    defaultValue: string;
    placeholder: string;
    svgSprite: string;
    error: string;
}>();

const emits = defineEmits<{
    (e: 'clear-error', field: string): void;
}>();

const clearError = (field: string) => {
    emits('clear-error', field);
};

const internalValue = ref(props.defaultValue);
const ru = ref(translate(props.defaultValue, 'ru'));
const ua = ref(translate(props.defaultValue, 'ua'));

const updateValueRu = (val) => {
    internalValue.value='[:ru]' + val + '[:ua]' + ua.value + '[:]';
};
const updateValueUa = (val) => {
    internalValue.value='[:ru]' + ru.value + '[:ua]' + val + '[:]';
};
// const err = wTrans(props.errors[props.name])
</script>

<template>
    <div class="input-with-icon" :class="{ error: error }">
        <svg>
            <use :xlink:href="`/__spritemap#sprite-${svgSprite}`"></use>
        </svg>
        <div>
            <Label for="name" class="font-very-small">{{ label }}</Label>
            <input type="hidden" :name="name" :value=internalValue>
            <InputLang
                autofocus
                :tabindex="tabindex"
                v-model:ru="ru"
                v-model:ua="ua"
                :placeholder=placeholder
                @clear-error=clearError(name)
                @update:ru="updateValueRu"
                @update:ua="updateValueUa"
            />
        </div>
        <span class="input-error">{{ error }}</span>
    </div>
</template>
