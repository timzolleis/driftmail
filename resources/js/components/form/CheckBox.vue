<template>
    <!--    <div class="flex flex-col gap-2 w-full">-->
    <!--        <label class="font-inter text-label-medium text-gray-600" v-if="useLabel">{{label}}</label>-->
    <!--        <textarea class="px-3 font-inter text-label-medium py-2 rounded ring ring-1 ring-gray-800/20 shadow shadow-lg focus:outline-none" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" type="text" required="{{required}}" />-->
    <!--    </div>-->
    <div class="flex items-center gap-2">
        <input :value="modelValue"  @input="$emit('update:modelValue', $event.target.checked)" type="checkbox"
               class="w-4 h-4">
        <label class="font-inter text-label-medium text-gray-600" v-if="useLabel">{{ label }}</label>
    </div>
</template>

<script setup lang="ts">

const props = defineProps<{
    label?: string;
    modelValue: any;
    useLabel: boolean;
}>()
const emits = defineEmits(["update:modelValue"])

</script>

<style scoped>

</style>
