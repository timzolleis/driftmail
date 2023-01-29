<template>
    <div class="flex items-center justify-between gap-2 pb-3">
        <h3 class="font-inter text-title-small font-medium text-gray-600">Projects</h3>
        <button class="px-3 py-1.5 rounded ring ring-1 ring-gray-600 text-white bg-black  font-inter" type="button" @click="router.get('/project/new')">
            <span class="flex items-center gap-2">
                <img src="/assets/img/add-icon.svg" class="h-6" alt="">
                Create
            </span>
        </button>
    </div>
    <CardContainer>
        <div v-if="projects.length > 0">
            <ProjectsTable :projects="projects"/>
        </div>
        <div v-else>
            <NoProjectsComponent/>
        </div>

    </CardContainer>


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

const props = defineProps<{ projects?: Project[] }>()
</script>

<style scoped>

</style>
