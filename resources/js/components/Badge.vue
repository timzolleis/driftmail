<script setup lang="ts">
import {cva, VariantProps} from "class-variance-authority";

const badgeVariants = cva(
    "inline-flex items-center border rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2",
    {
        variants: {
            variant: {
                default:
                    "bg-orange-100 text-orange-500 hover:bg-orange-200/80 border-transparent",
                secondary:
                    "bg-secondary hover:bg-secondary/80 border-transparent text-secondary-foreground",
                destructive:
                    "bg-destructive hover:bg-destructive/80 border-transparent text-destructive-foreground",
                outline: "text-foreground",
            },
        },
        defaultVariants: {
            variant: "default",
        },
    }
)

type ButtonProps = VariantProps<typeof badgeVariants>;
defineProps<{ variant?: ButtonProps["variant"]; }>();

</script>

<template>
    <div :class=badgeVariants({variant})>
        <slot/>
    </div>
</template>

<style scoped>

</style>
