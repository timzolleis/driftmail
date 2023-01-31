<template>
    <div class="flex flex-col gap-2 w-full">
        <label class="font-inter text-label-medium text-gray-600" v-if="useLabel">{{ label }}</label>
        <textarea
            ref="elementRef"
            class="block w-full rounded-md border border-gray-200 bg-white p-2 px-3 text-sm font-inter shadow-lg focus:border-black focus:outline-none focus:ring-0"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" type="text"/>
    </div>
</template>

<script setup lang="ts">
import {ref} from "@vue/reactivity";
import {onBeforeUnmount, onMounted} from "@vue/runtime-core";
import autosize from "autosize";

const elementRef = ref()

onMounted(() => {
        autosize(elementRef.value)
    }
)
onBeforeUnmount(() => {
    autosize.destroy(elementRef.value)
})

const props = defineProps<{
    label?: string;
    modelValue: any;
    useLabel: boolean;
}>()
const emits = defineEmits(["update:modelValue"])

</script>

<style scoped>

</style>
