<script setup lang="ts">
import { Input } from '@/components/ui/input/index.js';
import { Label } from '@/components/ui/label/index.js';

defineProps<{
    name: string;
    type: string;
    tabindex: string;
    label: string;
    defVal: string;
    placeholder: string;
    svgSprite: string;
    error:  string;
}>();

const emits = defineEmits<{
    (e: 'clear-error', field: string): void;
}>();

const clearError = (field: string) => {
    emits('clear-error', field);
};

</script>

<template>
    <div class="input-with-icon" :class="{ error: error }">
        <svg>
            <use :xlink:href="`/__spritemap#sprite-${svgSprite}`"></use>
        </svg>
        <div>
            <label for="name" class="font-very-small">{{ label }}</label>
            <Input
                class="input-single"
                :id="name"
                :type="type"
                autofocus
                :tabindex="tabindex"
                :name="name"
                :defaultValue="defVal"
                :placeholder=placeholder
                @clear-error=clearError(name)
            />
        </div>
        <span class="input-error">{{ error }}</span>
    </div>
</template>
