<template>
    <div
        class="flex items-center justify-between w-full rounded-md border border-gray-200 bg-white p-3 px-5 text-sm font-inter shadow-lg font-inter"
    >
        <div>
            <div class="flex items-center gap-2">
                <p class="font-medium text-label-large">{{ variable.key }}</p>
            </div>
            <p class="text-gray-600 text-label-small">
                {{ variable.description }}
            </p>
        </div>
        <span
            class="rounded-md py-1 px-3 text-label-small shadow-lg ring ring-1 ring-fuchsia-300"
            ><VariableScopeComponent
                :scope="scopes.find((scope) => scope.value === variable.scope)"
            ></VariableScopeComponent
        ></span>
        <OptionsMenu
            @edit="showEditModal = true"
            @delete="showDeleteModal = true"
            :options="options"
        >
        </OptionsMenu>
        <Teleport to="body">
            <Modal
                :show="showEditModal"
                @close="showEditModal = false"
                title="Edit Variable"
            >
                <div class="px-10">
                    <EditVariableComponent
                        @success="showEditModal = false"
                        :variable="variable"
                        :project="project"
                    ></EditVariableComponent>
                </div>
            </Modal>
            <ConfirmationModal
                @confirm="deleteVariable"
                @cancel="showDeleteModal = false"
                @close="showDeleteModal = false"
                :confirmation-text="`Are you sure you want to delete the variable ${variable.key}?`"
                :show-modal="showDeleteModal"
            ></ConfirmationModal>
        </Teleport>
    </div>
</template>

<script setup lang="ts">
import { Variable } from "../../models/Variable";
import OptionsMenu from "../common/OptionsMenu.vue";
import { DropdownOption } from "../../models/Select";
import { ref } from "@vue/reactivity";
import Modal from "../common/Modal.vue";
import AddVariableComponent from "./AddVariableComponent.vue";
import { Project } from "../../models/Project";
import EditVariableComponent from "./EditVariableComponent.vue";
import VariableScopeComponent from "./scope/VariableScopeComponent.vue";
import { scopes } from "../../config/props";
import { router } from "@inertiajs/vue3";
import ConfirmationModal from "../common/ConfirmationModal.vue";

const props = defineProps<{
    project: Project;
    variable: Variable;
}>();

const showEditModal = ref(false);
const showDeleteModal = ref(false);

function deleteVariable() {
    router.delete(`/project/${props.project.id}/variable/${props.variable.id}`);
    showDeleteModal.value = false;
}

const options: DropdownOption[] = [
    {
        name: "Edit",
        emit: "edit",
    },
    {
        name: "Delete",
        emit: "delete",
        color: "text-red-500",
    },
];
</script>

<style scoped></style>
