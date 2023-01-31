<template>
    <div class="flex items-center justify-between gap-2 pb-3">
        <h3 class="font-inter text-title-small font-medium text-gray-600">Projects</h3>
        <BlackButton button-text="Add" v-if="projects.length > 0"
                     class="px-3 py-1.5 rounded ring ring-1 ring-gray-600 text-white bg-black  font-inter" type="button"
                     @click="router.get('/project/new')">
        </BlackButton>
    </div>
            <CardContainer>
                <div v-if="projects.length > 0">
                    <ProjectsTable :projects="projects"/>
                </div>
                <div v-else>
                    <NotPresentComponent type="Project" link="/project/new"></NotPresentComponent>
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
import NotPresentComponent from "../common/NotPresentComponent.vue";
import BlackButton from "../common/BlackButton.vue";

const props = defineProps<{ projects?: Project[] }>()
</script>

<style scoped>

</style>
