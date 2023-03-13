<template>
    <div class="flex py-3 justify-between border-b">
        <PageHeader title="Variables"/>
        <BlackButton
            button-text="Add"
            class="rounded ring ring-1 ring-gray-600 text-white bg-black font-inter"
            type="button"
            @click="openAddModal"
        >
        </BlackButton>
    </div>
    <VariableModal :variable="variable"></VariableModal>
    <main class="space-y-1 py-3">
        <VariableComponent
            v-for="variable in variables"
            :variable="variable"
            :project="project"
        ></VariableComponent>
    </main>
</template>

<script setup lang="ts">
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import {Variable} from "../../models/Variable";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import BlackButton from "../../components/common/BlackButton.vue";
import {Project} from "../../models/Project";
import VariableComponent from "../../components/variables/VariableComponent.vue";
import VariableModal from "../../components/variables/VariableModal.vue";
import {ref} from "@vue/reactivity";

defineOptions({layout: ProjectLayout});
const props = defineProps<{
    project: Project;
    variables: Variable[];
    variable: Variable | null
}>();

function openAddModal(){
    const searchParams = new URLSearchParams(window.location.search)
    searchParams.set("modal", "true")
    window.location.search = searchParams.toString()
}


const add = ref(false)


</script>

<style scoped></style>
