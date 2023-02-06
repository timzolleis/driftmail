<template>
    <Teleport to="body">
        <Modal :show="showDeletionModal" title="Confirm deletion" @close="showDeletionModal = false">
            <DeleteProjectConfirmationComponent @confirm="deleteProject"
                                                @cancel="showDeletionModal = false"
                                                :project="project"></DeleteProjectConfirmationComponent>
        </Modal>
    </Teleport>

    <section class="py-5 space-y-2">
        <TextInput
            :error-message="form.errors.apiKey"
            v-model="form.apiKey"
            :use-label="true"
            label="API key"
        >
            <template v-slot:after-input>
                <BlackButton @click="generateApiKey" button-text="Regenerate"></BlackButton>
            </template>

        </TextInput>
        <label class="font-inter text-label-medium text-gray-600">Mail configuration</label>
        <CardContainer>
            <MailSettingsComponent v-model="form"></MailSettingsComponent>
        </CardContainer>
        <div class="grid grid-cols-2 gap-2">
            <section class="font-inter">
                <CardContainer class="space-y-2">
                    <p class="font-medium text-label-large">Delete project</p>
                    <p class="text-gray-600 text-xs">Permanently delete your project and all associated templates,
                        variables and settings. This action cannot be undone!</p>
                    <BlackButton @click="showDeletionModal = true" class="bg-red-500 text-white border-red-500"
                                 button-text="Delete Project"></BlackButton>
                </CardContainer>
            </section>
            <section class="font-inter">
                <CardContainer class="space-y-2">
                    <p class="font-medium text-label-large">Export project</p>
                    <p class="text-gray-600 text-xs">Export your project settings to a .json file. Please keep in mind that this file is not encoded! Exclude any sensitive data.</p>
                    <BlackButton @click="exportProject"
                                 button-text="Export Project"></BlackButton>
                </CardContainer>
            </section>
        </div>
        <BlackButton
            @click="saveForm"
            class="w-full mt-5 py-3"
            button-text="Save"
        ></BlackButton>
    </section>
</template>

<script setup lang="ts">

import {Project, ProjectSettings} from "../../models/Project";
import TextInput from "../form/TextInput.vue";
import BlackButton from "../common/BlackButton.vue";
import {useSettingsForm} from "../../composables/settings";
import {useApiKey} from "../../composables/key";
import PasswordInput from "../form/PasswordInput.vue";
import {useGetRelativeUrl} from "../../composables/navigation";
import CardContainer from "../../Shared/Layout/CardContainer.vue";
import MailSettingsComponent from "./MailSettingsComponent.vue";
import {ref} from "@vue/reactivity";
import Modal from "../common/Modal.vue";
import DeleteProjectConfirmationComponent from "../projects/DeleteProjectConfirmationComponent.vue";
import {router} from "@inertiajs/vue3";

const props = defineProps<{
    project: Project
    settings?: ProjectSettings
}>()
const form = useSettingsForm(props.settings)

const showDeletionModal = ref(false)

function generateApiKey() {
    form.apiKey = useApiKey()
}

function deleteProject() {
    return router.delete(useGetRelativeUrl('/project', '/'))
}

function saveForm() {
    return form.post(useGetRelativeUrl('/project', '/settings'))
}

function exportProject(){
   window.open(useGetRelativeUrl('/project', '/settings/export'), '_blank')
}

</script>

<style scoped>

</style>
