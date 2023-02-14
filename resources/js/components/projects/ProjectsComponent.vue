<template>
    <CardContainer>
        <div class="flex items-center justify-between">
            <section class="space-y-1">
                <p class="font-medium text-title-small">
                    {{ project.name }}
                </p>
                <p class="text-gray-600">{{ project.description }}</p>
            </section>
            <DefaultButton
                @click="router.get(`/project/${project.id}`)"
                button-text="View"
            ></DefaultButton>
        </div>
    </CardContainer>
</template>

<script lang="ts">
import CardContainer from "../../Shared/Layout/CardContainer.vue";

export default {
    name: "ProjectsComponent",
    components: { CardContainer },
};
</script>

<script setup lang="ts">
import { Project } from "../../models/Project";
import DefaultButton from "../common/BlackButton.vue";
import Modal from "../common/Modal.vue";
import AddProjectComponent from "./AddProjectComponent.vue";
import { ref } from "@vue/reactivity";
import { router } from "@inertiajs/vue3";
import PageHeader from "../../Shared/Page/PageHeader.vue";

const showModal = ref(false);

const props = defineProps<{ project?: Project }>();
</script>

<style scoped></style>
