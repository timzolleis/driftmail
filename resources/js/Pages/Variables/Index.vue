<template>
    <PageHeader>
        <template v-slot:title>Variables</template>
        <template v-slot:cta>
            <AddVariable></AddVariable>
        </template>
    </PageHeader>
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
import AddProject from "../../components/projects/AddProject.vue";
import {Template} from "../../models/Template";
import AddVariable from "../../components/variables/AddVariable.vue";

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
