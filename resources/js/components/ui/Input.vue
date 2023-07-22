<script setup lang="ts">
import {useComponentVModel} from "../../composables/general";

const props = defineProps<{ modelValue: string }>();
const emit = defineEmits<{ (e: 'update:modelValue', value: string): void }>();

</script>

<template>
      <input @input="(event) => emit('update:modelValue', event.target.value)" :value="props.modelValue" type="text"
             class="flex h-9 w-full rounded-md border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
</template>

<style scoped>

</style>
