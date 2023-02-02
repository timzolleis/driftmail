<template>
    <ProjectsComponent :projects="projects"></ProjectsComponent>
</template>

<script lang="ts">
import AuthenticatedLayout from "../Shared/Layout/AuthenticatedLayout.vue";
import ProjectsComponent from "../components/projects/ProjectsComponent.vue";

export default {
    name: "Index",
    components: { ProjectsComponent },
    layout: AuthenticatedLayout,
};
</script>

<script setup lang="ts">
import { Project } from "../models/Project";
import { Template } from "../models/Template";

const props = defineProps<{
    projects?: Project[];
}>();
</script>

<style scoped></style>
