<template>
    <div
        class="flex items-center justify-between w-full rounded-md border border-gray-200 bg-white p-3 px-5 text-sm font-inter shadow-lg font-inter"
    >
        <div class="flex gap-5 items-start">
            <div>
                <div class="flex gap-5 items-center">
                    <p class="font-medium text-label-large">{{ variable.key }}</p>
                    <div
                        class="rounded-md py-1 px-3 text-label-small shadow-lg ring ring-1 ring-fuchsia-300"
                    >
                        <VariableScopeComponent
                            :scope="
                        scopes.find((scope) => scope.value === variable.scope)
                    "
                        ></VariableScopeComponent>
                    </div>
                </div>
                <p class="text-gray-600 text-label-small leading-4 mt-1">
                    {{ variable.description }}...
                </p>
            </div>

        </div>
        <div class="relative">
            <OptionsMenu
                @edit="router.get(useDynamicUrl('/project/{id}', `/variables/${variable.id}`), {}, {preserveState: true})"
                @delete="showDeleteModal = true"
                :options="options"
            >
            </OptionsMenu>
        </div>
        <Teleport to="body">
            <ConfirmationModal
                @confirm="router.delete(useDynamicUrl('/project/{id}', `/variables/${variable.id}`))"
                @cancel="showDeleteModal = false"
                @close="showDeleteModal = false"
                :confirmation-text="`Are you sure you want to delete the variable ${variable.key}?`"
                :show-modal="showDeleteModal"
            ></ConfirmationModal>
        </Teleport>
    </div>
</template>

<script setup lang="ts">
import {Variable} from "../../models/Variable";
import OptionsMenu from "../common/OptionsMenu.vue";
import {DropdownOption} from "../../models/Select";
import {ref} from "@vue/reactivity";
import {Project} from "../../models/Project";
import VariableScopeComponent from "./scope/VariableScopeComponent.vue";
import {scopes} from "../../config/props";
import ConfirmationModal from "../common/ConfirmationModal.vue";
import {router} from "@inertiajs/vue3";
import {useDynamicUrl, useGetRelativeUrl} from "../../composables/navigation";

const props = defineProps<{
    project: Project;
    variable: Variable;
}>();

const showDeleteModal = ref(false);
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
