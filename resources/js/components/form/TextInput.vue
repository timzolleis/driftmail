<template>
    <div class="flex flex-col gap-1 py-2 w-full">
        <div class="flex gap-2 items-center">
            <div class="w-full">
                <input
                    class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 bg-white file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    :value="modelValue"
                    @input="$emit('update:modelValue', $event.target.value)"
                    type="text"
                    :placeholder="placeholder"
                />
                <p
                    v-if="errorMessage"
                    class="font-inter text-red-500 text-label-small py-2 "
                >
                    {{ errorMessage }}
                </p>
            </div>
            <slot name="after-input"></slot>
        </div>
    </div>
</template>

<script setup lang="ts">
import Label from "../Label.vue";

const props = defineProps<{
    errorMessage?: string;
    modelValue: any;
    placeholder?: string;
}>();

const emits = defineEmits(["update:modelValue"]);
</script>

<style scoped></style>
