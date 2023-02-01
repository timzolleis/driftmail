<template>
    <div class="font-inter text-center space-y-2">
        <div>
        <h2 class="text-title-small font-semibold">You do not have any projects</h2>
        <p class="text-label-medium text-gray-600">To get started, create a new Project</p>
        </div>
        <BlackButton buttonText="Add Project"></BlackButton>
    </div>

</template>

<script>
import {Link} from '@inertiajs/vue3'
import BlackButton from "@/components/common/BlackButton.vue";

export default {
    name: "NoProjectsComponent",
    components: {BlackButton, Link}
}
</script>

<style scoped>

</style>
