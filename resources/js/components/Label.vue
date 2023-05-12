<script setup lang="ts">
import {cva} from "class-variance-authority";

const labelVariants = cva(
    "text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-900"
)
</script>

<template>
    <label :class="labelVariants()">
        <slot></slot>
    </label>
</template>

<style scoped>

</style>
