<script setup lang="ts">
import {cva, VariantProps} from "class-variance-authority";

const labelVariants = cva(
    "text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70",
    {
        variants: {
            variant: {
                default: "",
                error: "text-destructive"
            }
        },
        defaultVariants: {
            variant: "default"
        }
    }
)
defineProps<{variant?: VariantProps<typeof labelVariants>["variant"]}>()

</script>

<template>
<label :class="labelVariants({variant})"><slot/></label>
</template>

<style scoped>

</style>
