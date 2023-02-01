<template>
    <div class="flex flex-col gap-1 py-2 w-full">
        <label class="font-inter text-label-medium text-gray-600" v-if="useLabel">{{ label }}</label>
        <input
            class="block w-full rounded-md border border-gray-200 bg-white p-2 px-3 text-sm font-inter shadow-lg focus:border-black focus:outline-none focus:ring-0"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" type="text" :placeholder="placeholder">
        <p v-if="errorMessage" class="font-inter text-red-500 text-label-small">{{ errorMessage }}</p>
    </div>
</template>

<script setup lang="ts">

const props = defineProps<{
    label?: string;
    errorMessage?: string;
    modelValue: any;
    useLabel: boolean,
    placeholder?: string
}>()

console.log(props.errorMessage)
const emits = defineEmits(["update:modelValue"])

</script>

<style scoped>

</style>
