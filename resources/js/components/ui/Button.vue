<script setup lang="ts">
import {cva, VariantProps} from "class-variance-authority";
import Loader from "./Loader.vue";
import {useRouterLoading} from "../../composables/general";
const buttonVariants = cva(
    "inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 gap-2",
    {
        variants: {
            variant: {
                default:
                    "bg-primary text-primary-foreground shadow hover:bg-primary/90",
                destructive:
                    "bg-destructive text-destructive-foreground shadow-sm hover:bg-destructive/90",
                outline:
                    "border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground",
                secondary:
                    "bg-secondary text-secondary-foreground shadow-sm hover:bg-secondary/80",
                ghost: "hover:bg-accent hover:text-accent-foreground",
                link: "text-primary underline-offset-4 hover:underline",
            },
            size: {
                default: "h-9 px-4 py-2",
                sm: "h-8 rounded-md px-3 text-xs",
                lg: "h-10 rounded-md px-8",
                icon: "h-9 w-9",
            },
        },
        defaultVariants: {
            variant: "default",
            size: "default",
        },
    }
)
type ButtonProps = VariantProps<typeof buttonVariants>
withDefaults(
    defineProps<{ variant: ButtonProps["variant"]; size: ButtonProps["size"], loading?: boolean }>(),
    {
        variant: "default",
        size: "default",
    }
);
const {id, isRouterLoading} = useRouterLoading()
</script>

<template>
    <button :id="id" :class="buttonVariants({variant: variant , size: size })">
        <Loader v-if="loading || isRouterLoading "></Loader>
        <slot v-else/></button>
</template>

<style scoped>

</style>
