<template>
    <div class="flex py-3 justify-between border-b">
        <PageHeader title="Variables" />
        <BlackButton
            button-text="Add"
            class="rounded ring ring-1 ring-gray-600 text-white bg-black font-inter"
            type="button"
            @click="showModal = true"
        >
        </BlackButton>
    </div>
    <div>
        <Modal
            :show="showModal"
            @close="showModal = false"
            title="Add Variable"
        >
            <div class="px-10">
                <AddVariableComponent
                    :project="project"
                    @success="showModal = false"
                ></AddVariableComponent>
            </div>
        </Modal>
    </div>
    <main class="py-3">
        <VariableComponent
            v-for="variable in variables"
            :variable="variable"
            :project="project"
        ></VariableComponent>
    </main>
</template>

<script setup lang="ts">
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import { Variable } from "../../models/Variable";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import BlackButton from "../../components/common/BlackButton.vue";
import AddVariableComponent from "../../components/variables/AddVariableComponent.vue";
import { ref } from "@vue/reactivity";
import Modal from "../../components/common/Modal.vue";
import { Project } from "../../models/Project";
import VariableComponent from "../../components/variables/VariableComponent.vue";

defineOptions({ layout: ProjectLayout });
const showModal = ref(false);
const props = defineProps<{
    project: Project;
    variables: Variable[];
}>();
</script>

<style scoped></style>
