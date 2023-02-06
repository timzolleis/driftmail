<template>
    <div
        class="flex items-center justify-between w-full rounded-md border border-gray-200 bg-white p-3 px-5 text-sm font-inter shadow-lg font-inter"
    >
        <div>
            <div class="flex items-center gap-2">
                <p class="font-medium text-label-large">{{ template.name }}</p>
            </div>
            <p class="text-gray-600 text-label-small">
                {{ template.description }}
            </p>
        </div>
        <OptionsMenu
            @edit="showEditModal = true"
            @delete="showDeleteModal = true"
            :options="options"
        >
        </OptionsMenu>
    </div>
    <Teleport to="body">
        <ConfirmationModal
            @confirm="deleteTemplate"
            @cancel="showDeleteModal = false"
            @close="showDeleteModal = false"
            :confirmation-text="`Are you sure you want to delete the Template ${template.name}?`"
            :show-modal="showDeleteModal"
        >
        </ConfirmationModal>
        <LargeModal title="Edit template" :show="showEditModal">
            <EditTemplateComponent
                :template="template"
                @success="showEditModal = false"
            ></EditTemplateComponent>
        </LargeModal>
    </Teleport>
</template>

<script setup lang="ts">
import {Template} from "../../models/Template";
import {
    useGetRelativeUrl,
    useRelativeNavigation,
} from "../../composables/navigation";
import OptionsMenu from "../common/OptionsMenu.vue";
import {DropdownOption} from "../../models/Select";
import {ref} from "@vue/reactivity";
import ConfirmationModal from "../common/ConfirmationModal.vue";
import LargeModal from "../common/LargeModal.vue";
import CreateTemplateComponent from "./CreateTemplateComponent.vue";
import {router, useForm} from "@inertiajs/vue3";
import EditTemplateComponent from "./EditTemplateComponent.vue";
import Modal from "../common/Modal.vue";

const props = defineProps<{
    template: Template;
}>();
const templateForm = useForm({
    name: "",
    description: "",
    subject: "",
    body: "",
});
export type TemplateForm = typeof templateForm;

const showDeleteModal = ref(false);
const showEditModal = ref(false);
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

function deleteTemplate() {
    router.delete(
        useGetRelativeUrl("/project", `/template/${props.template.id}`), {
            onSuccess: () => showDeleteModal.value = false
        }
    );

}
</script>
