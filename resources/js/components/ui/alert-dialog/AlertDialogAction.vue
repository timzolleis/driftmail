<script setup lang="ts">
import {AlertDialogAction as AlertDialogPrimitiveAction} from "radix-vue";
import Button from "../Button.vue";
</script>

<template>
<AlertDialogPrimitiveAction :as-child="true">
    <Button>
        <slot/>
    </Button>
</AlertDialogPrimitiveAction>
</template>

<style scoped>

</style>
