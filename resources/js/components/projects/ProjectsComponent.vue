<template>
    <CardContainer>
        <div v-if="projects.length > 0">
            <p>Your Projects go here</p>
        </div>
        <div v-else>
            <NoProjectsComponent />
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
const props = defineProps<{projects?: Project[]}>()
</script>

<style scoped>

</style>
