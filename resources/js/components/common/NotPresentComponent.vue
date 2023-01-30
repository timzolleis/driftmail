<template>
    <div class="font-inter text-center space-y-2">
        <div>
            <h2 class="text-title-small font-semibold">You do not have any {{type.toLowerCase()}}s</h2>
            <p class="text-label-medium text-gray-600">To get started, create a new {{ type.toLowerCase() }}</p>
        </div>
        <BlackButton @click="router.get(link)" :buttonText="`Add ${type}`"></BlackButton>
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
