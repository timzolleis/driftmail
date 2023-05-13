<script setup lang="ts">
import {cva, type VariantProps} from "class-variance-authority";
import {Loader2} from "lucide-vue-next";

const buttonVariants = cva(
    "inline-flex items-center gap-2 justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-70 disabled:pointer-events-none ring-offset-background",
    {
        variants: {
            variant: {
                default: "bg-primary text-primary-foreground hover:bg-primary/90",
                destructive:
                    "bg-destructive text-destructive-foreground hover:bg-destructive/90",
                colorful: "bg-indigo-600 text-white hover:bg-indigo-600/90",
                outline:
                    "border border-input hover:bg-accent hover:text-accent-foreground",
                secondary:
                    "bg-secondary text-secondary-foreground hover:bg-secondary/80",
                ghost: "hover:bg-accent hover:text-accent-foreground",
                link: "underline-offset-4 hover:underline text-primary",
            },
            size: {
                default: "h-10 py-2 px-4",
                sm: "h-9 px-3 rounded-md",
                lg: "h-11 px-8 rounded-md",
            },
        },
        defaultVariants: {
            variant: "default",
            size: "default",
        },
    }
)
type ButtonProps = VariantProps<typeof buttonVariants>;
defineProps<{ variant?: ButtonProps["variant"]; size?: ButtonProps["size"], loading?: boolean }>();

</script>

<template>
    <button type="button" :disabled="loading" :class="buttonVariants({variant, size})">
        <Loader2 v-if="loading" class="animate-spin" :size="18"></Loader2>
        <slot/>
    </button>
</template>

<style scoped>

</style>
