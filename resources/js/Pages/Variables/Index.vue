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
        <Teleport to="body">
            <Modal
                :show="showModal"
                @close="showModal = false"
                title="Add Variable"
            >
                <VariableFormComponent
                    @save="(form) => handleClick(form)"
                    :intent="intent"
                    :variable="currentVariable"
                ></VariableFormComponent>
            </Modal>
        </Teleport>
    </div>
    <main class="space-y-1 py-3">
        <VariableComponent
            @edit="(variable) => editVariable(variable)"
            @delete="(variable) => deleteVariable(variable)"
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
import { ref } from "@vue/reactivity";
import Modal from "../../components/common/Modal.vue";
import { Project } from "../../models/Project";
import VariableComponent from "../../components/variables/VariableComponent.vue";
import { VariableForm } from "../../composables/variable";
import { useGetRelativeUrl } from "../../composables/navigation";
import { useModal } from "../../composables/modal";
import { router } from "@inertiajs/vue3";
import VariableFormComponent from "../../components/variables/VariableFormComponent.vue";
import {Intent} from "../../models/Form";
defineOptions({ layout: ProjectLayout });
const props = defineProps<{
    project: Project;
    variables: Variable[];
}>();
const { showModal, openModal, closeModal } = useModal();
const currentVariable = ref<Variable | undefined>();
const intent = ref<Intent>("add");

function editVariable(variable: Variable) {
    currentVariable.value = variable;
    intent.value = "edit";
    openModal();
}

function handleClick(form: VariableForm) {
    if (currentVariable.value) {
        return form.put(
            useGetRelativeUrl(
                "/project",
                `/variable/${currentVariable.value?.id}`
            ),
            {
                onSuccess: () => resetPage(),
            }
        );
    }
    return form.post(useGetRelativeUrl("/project", "/variable/new"), {
        onSuccess: () => resetPage(),
    });
}

function deleteVariable(variable: Variable) {
    return router.delete(
        useGetRelativeUrl("/project", `/variable/${variable.id}`)
    );
}

function resetPage() {
    closeModal();
    currentVariable.value = undefined;
    intent.value = "add";
}
</script>

<style scoped></style>
