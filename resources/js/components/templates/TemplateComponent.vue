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
            @edit="emit('edit', template)"
            @delete="showDeleteModal = true"
            :options="options"
        >
        </OptionsMenu>
    </div>
    <Teleport to="body">
        <ConfirmationModal
            @confirm="emit('delete', template)"
            @cancel="showDeleteModal = false"
            @close="showDeleteModal = false"
            :confirmation-text="`Are you sure you want to delete the Template ${template.name}?`"
            :show-modal="showDeleteModal"
        >
        </ConfirmationModal>
    </Teleport>
</template>

<script setup lang="ts">
import { Template } from "../../models/Template";
import OptionsMenu from "../common/OptionsMenu.vue";
import { DropdownOption } from "../../models/Select";
import { ref } from "@vue/reactivity";
import ConfirmationModal from "../common/ConfirmationModal.vue";

const props = defineProps<{
    template: Template;
}>();

const emit = defineEmits(["edit", "delete"]);
const showDeleteModal = ref<boolean>(false);

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
