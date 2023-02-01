<template>
    <div class="flex py-3 justify-between border-b">

        <PageHeader title="My Projects"/>
        <DefaultButton button-text="Add"
                     class="rounded ring ring-1 ring-gray-600 text-white bg-black font-inter" type="button"
                     @click="showModal = true">
        </DefaultButton>
    </div>
    <Modal :show="showModal" @close="showModal = false" title="Add Project">
        <div class="px-10">
            <AddProjectComponent @success="showModal = false"></AddProjectComponent>
        </div>
    </Modal>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 font-inter py-4">
        <CardContainer v-for="project in projects">
            <div class="flex items-center justify-between">
                <section class="space-y-1">
                    <p class="font-medium text-title-small">{{ project.name }}</p>
                    <p class="text-gray-600">{{ project.description }}</p>
                </section>
                <DefaultButton button-text="View"></DefaultButton>
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
import DefaultButton from "../common/BlackButton.vue";
import Modal from "../common/Modal.vue";
import Create from "../../Pages/Project/Edit.vue";
import AddProjectComponent from "./AddProjectComponent.vue";
import {ref} from "@vue/reactivity";
import {router} from "@inertiajs/vue3";
import PageHeader from "../../Shared/Page/PageHeader.vue";

const showModal = ref(false)

const props = defineProps<{ projects?: Project[] }>()
</script>

<style scoped>

</style>
