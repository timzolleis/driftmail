<template>
    <div class="flex py-3 justify-between border-b w-full">
        <PageHeader title="My Projects" />
        <BlackButton
            button-text="Add"
            class="rounded ring ring-1 ring-gray-600 text-white bg-black font-inter"
            type="button"
            @click="openModal"
        >
        </BlackButton>
    </div>
    <Modal :show="showModal" @close="closeModal" title="Add Project">
        <div class="px-10">
            <AddProjectComponent @success="closeModal"></AddProjectComponent>
        </div>
    </Modal>
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
    components: { ProjectsComponent },
    layout: AuthenticatedLayout,
};
</script>

<script setup lang="ts">
import { Project } from "../models/Project";
import { Template } from "../models/Template";
import PageHeader from "../Shared/Page/PageHeader.vue";
import { useModal } from "../composables/modal";
import AddProjectComponent from "../components/projects/AddProjectComponent.vue";
import Modal from "../components/common/Modal.vue";
import BlackButton from "../components/common/BlackButton.vue";

const props = defineProps<{
    projects?: Project[];
}>();
const { showModal, openModal, closeModal } = useModal();
</script>

<style scoped></style>
