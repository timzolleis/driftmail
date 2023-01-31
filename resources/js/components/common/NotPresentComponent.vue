<template>
    <div class="font-inter text-center space-y-2">
        <div class="flex flex-col items-center w-full gap-2">
            <h2 class="text-title-medium font-semibold">You do not have any {{type.toLowerCase()}}s</h2>
            <img class="h-40" src="/assets/img/project-illustration.svg" alt="">
        </div>
       <div class="pt-2">
           <BlackButton @click="router.get(link)" :buttonText="`Add ${type}`"></BlackButton>
       </div>
    </div>

</template>

<script setup lang="ts">
import {Link, router} from '@inertiajs/vue3'
import BlackButton from "./BlackButton.vue";


const props = defineProps<{
    link: string;
    type: string
}>()
</script>

<style scoped>

</style>
