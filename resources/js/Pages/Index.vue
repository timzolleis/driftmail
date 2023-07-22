<template>
    <PageHeader>
        <template v-slot:title>My projects</template>
        <template v-slot:cta>
            <AddProject></AddProject>
        </template>
    </PageHeader>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 font-inter py-4">
        <ProjectsComponent
            v-for="project in projects"
            :project="project"
        ></ProjectsComponent>
    </div>
</template>

<script lang="ts">
import AuthenticatedLayout from "../Shared/Layout/AuthenticatedLayout.vue";
import ProjectsComponent from "../components/projects/ProjectsComponent.vue";

export default {
    name: "Index",
    components: {ProjectsComponent},
    layout: AuthenticatedLayout,
};
</script>

<script setup lang="ts">
import {Project} from "../models/Project";
import {Template} from "../models/Template";
import PageHeader from "../Shared/Page/PageHeader.vue";
import {useModal} from "../composables/modal";
import AddProject from "../components/projects/AddProject.vue";
import Modal from "../components/common/Modal.vue";
import BlackButton from "../components/common/BlackButton.vue";
import Button from "../components/ui/Button.vue";
import {Plus} from "lucide-vue-next"
const props = defineProps<{
    projects?: Project[];
}>();
</script>

<style scoped></style>
