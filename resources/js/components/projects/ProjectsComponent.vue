<template>
    <div class="grid grid-cols-3 gap-2 font-inter ">
        <CardContainer v-for="project in projects">
            <div class="flex items-center justify-between">
                <section class="space-y-1">
                    <p class="font-medium text-title-small">{{ project.name }}</p>
                    <p class="text-gray-600">{{ project.description }}</p>
                </section>
                <BlackButton button-text="View"></BlackButton>
            </div>
        </CardContainer>
    </div>

</template>

<script lang="ts">
import CardContainer from "../../Shared/Layout/CardContainer.vue";

export default {
    name: "ProjectsComponent",
    components: {CardContainer}
}
</script>

<script setup lang="ts">
import {Project} from "../../models/Project";
import NoProjectsComponent from "./NoProjectsComponent.vue";
import ProjectsTable from "../table/ProjectsTable.vue";
import {router} from "@inertiajs/vue3";
import NotPresentComponent from "../common/NotPresentComponent.vue";
import BlackButton from "../common/BlackButton.vue";

const props = defineProps<{ projects?: Project[] }>()
</script>

<style scoped>

</style>
