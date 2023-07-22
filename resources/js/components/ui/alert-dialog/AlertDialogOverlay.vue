<script setup lang="ts">
import {AlertDialogOverlay as AlertDialogPrimitiveOverlay} from "radix-vue";
</script>

<template>
<AlertDialogPrimitiveOverlay class="fixed inset-0 z-50 bg-background/80 backdrop-blur-sm data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0">
    <slot/>
</AlertDialogPrimitiveOverlay>
</template>

<style scoped>

</style>
