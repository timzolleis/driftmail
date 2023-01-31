<template>
    <Modal title="Add Project">
        <AddProjectComponent></AddProjectComponent>
    </Modal>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 font-inter ">
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
import BlackButton from "../common/BlackButton.vue";
import Modal from "../common/Modal.vue";
import Create from "../../Pages/Project/Edit.vue";
import AddProjectComponent from "./AddProjectComponent.vue";

const props = defineProps<{ projects?: Project[] }>()
</script>

<style scoped>

</style>
