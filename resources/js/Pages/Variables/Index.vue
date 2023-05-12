<template>
    <div>
        <div class="flex py-3 justify-between border-b">
            <PageHeader title="Variables"/>
            <StyledButton
                type="button"
                @click="router.get('variables/add', {}, {preserveState: true})"
            >Add
            </StyledButton>
        </div>
        <VariableModal :add="add" :variable="variable"></VariableModal>
        <main class="py-3 grid gap-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 ">
            <VariableComponent
                v-for="variable in variables"
                :key="variable.id"
                :variable="variable"
                :project="project"
            ></VariableComponent>
        </main>
    </div>
</template>

<script setup lang="ts">
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import {Variable} from "../../models/Variable";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import {Project} from "../../models/Project";
import VariableComponent from "../../components/variables/VariableComponent.vue";
import VariableModal from "../../components/variables/VariableModal.vue";
import {ref} from "@vue/reactivity";
import StyledButton from "../../components/StyledButton.vue";
import {router} from "@inertiajs/vue3";

defineOptions({layout: ProjectLayout});
const props = defineProps<{
    project: Project;
    variables: Variable[];
    variable: Variable | undefined
}>();

router.on('start', event => {
    add.value = event.detail.visit.url.pathname.endsWith('add');
})
const add = ref(window.location.pathname.endsWith("add"))


</script>

<style scoped></style>
