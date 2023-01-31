<template>
    <div
        class="backdrop-blur bg-black bg-opacity-10 p-3 fixed lg:px-60 left-0 top-0 right-0 bottom-0 flex flex-col items-center justify-center">
        <div class="rounded-xl bg-white w-full md:w-3/6" >
            <div class="flex flex-col py-5">
                <div
                    class="flex flex-col gap-2  items-center font-bold font-inter text-headline-small border-b border-gray-600/20 pb-2">
                    <img class="h-10" src="/assets/img/mail-icon.svg" alt="">
                    <p class="font-inter text-title-small font-semibold">{{ title }}</p>
                </div>
                <div class="bg-gray-50">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">

const props = defineProps<{
    title: string;
}>()

</script>

<style scoped>

</style>
