<template>
    <div class="flex flex-col gap-2 w-full">
        <label class="font-inter text-label-medium text-gray-600" v-if="useLabel">{{ label }}</label>
        <input
            class="px-3 font-inter text-label-medium py-2 rounded ring ring-1 ring-gray-800/20 shadow shadow-lg focus:outline-none"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" type="text">
        <p v-if="errorMessage" class="font-inter text-red-500 text-label-small">{{ errorMessage }}</p>
    </div>
</template>

<script setup lang="ts">

const props = defineProps<{
    label?: string;
    errorMessage?: string;
    modelValue: any;
    useLabel: boolean
}>()

console.log(props.errorMessage)
const emits = defineEmits(["update:modelValue"])

</script>

<style scoped>

</style>
