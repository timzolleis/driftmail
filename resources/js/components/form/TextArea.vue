<template>
    <div class="flex flex-col gap-2 w-full">
        <textarea
            id="textarea"
            :placeholder="placeholder"
            ref="elementRef"
            class="flex h-20 w-full rounded-md border border-input bg-white px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            type="text"
        />
        <p v-if="errorMessage" class="font-inter text-red-500 text-label-small">
            {{ errorMessage }}
        </p>
    </div>
</template>

<script setup lang="ts">
import {Ref, ref} from "@vue/reactivity";
import {onBeforeUnmount, onMounted} from "@vue/runtime-core";
import autosize from "autosize";

const props = defineProps<{
    modelValue: any;
    errorMessage?: string;
    placeholder?: string;
}>();

const elementRef = ref()

onMounted(() => {
    autosize(elementRef.value);
});
onBeforeUnmount(() => {
    autosize.destroy(elementRef.value);
});


const emits = defineEmits(["update:modelValue"]);
</script>

<style scoped></style>
