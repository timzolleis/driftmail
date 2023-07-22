<script setup lang="ts">
import {AlertDialogCancel as AlertDialogPrimitiveCancel} from "radix-vue";
import Button from "../Button.vue";
</script>

<template>
<AlertDialogPrimitiveCancel :as-child="true">
    <Button  variant="outline">
        <slot/>
    </Button>
</AlertDialogPrimitiveCancel>
</template>

<style scoped>

</style>
