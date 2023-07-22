<script setup lang="ts">
import {
    AlertDialogRoot,
    AlertDialogTrigger,
    AlertDialogContent,
    AlertDialogOverlay,
    AlertDialogCancel,
    AlertDialogAction,
    AlertDialogPortal,
    AlertDialogTitle,
    AlertDialogDescription,
} from "radix-vue";
</script>

<template>
    <AlertDialogRoot>
        <AlertDialogTrigger
            class="bg-white text-grass11 font-semibold hover:bg-white/90 shadow-sm inline-flex h-[35px] items-center justify-center rounded-[4px] px-[15px] leading-none outline-none focus:shadow-[0_0_0_2px] focus:shadow-black transition-all"
        >Delete account
        </AlertDialogTrigger>
        <AlertDialogPortal>
            <AlertDialogOverlay class="alert-dialog-overlay" />
            <AlertDialogContent
                class="alert-dialog-content"
            >
                <AlertDialogTitle class="text-mauve12 m-0 text-[17px] font-semibold"> Are you absolutely sure? </AlertDialogTitle>
                <AlertDialogDescription class="text-mauve11 mt-4 mb-5 text-[15px] leading-normal">
                    This action cannot be undone. This will permanently delete your account and remove your data from our servers.
                </AlertDialogDescription>
                <div class="flex justify-end gap-[25px]">
                    <AlertDialogCancel
                        class="text-mauve11 bg-mauve4 hover:bg-mauve5 focus:shadow-mauve7 inline-flex h-[35px] items-center justify-center rounded-[4px] px-[15px] font-semibold leading-none outline-none focus:shadow-[0_0_0_2px]"
                    >
                        Cancel
                    </AlertDialogCancel>
                    <AlertDialogAction
                        @click="handleAction"
                        class="text-red11 bg-red4 hover:bg-red5 focus:shadow-red7 inline-flex h-[35px] items-center justify-center rounded-[4px] px-[15px] font-semibold leading-none outline-none focus:shadow-[0_0_0_2px]"
                    >
                        Yes, delete account
                    </AlertDialogAction>
                </div>
            </AlertDialogContent>
        </AlertDialogPortal>
    </AlertDialogRoot>
</template>

<style scoped>

</style>
