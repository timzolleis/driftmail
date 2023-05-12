<template>
    <div>
        <Teleport to="body">
            <Modal
                :title="intent === 'add' ? `Add Template` : `Edit Template`"
                :show="show"
                @close="router.get(useNegativeNavigation(1))"
            >
                <TemplateFormComponent
                    :template="template"
                    @save="(form) => handleClick(form)"
                ></TemplateFormComponent>
            </Modal>
        </Teleport>
        <div class="flex py-3 justify-between border-b">
            <PageHeader title="Templates"/>
            <StyledButton
                type="button"
                @click="openModal"
            >
                Add
            </StyledButton>
        </div>
        <main class="py-3 space-y-2">
            <TemplateComponent
                @delete="(template) => deleteTemplate(template)"
                v-for="template in templates"
                :template="template"
            ></TemplateComponent>
        </main>
    </div>
</template>

<script setup lang="ts">
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import BlackButton from "../../components/common/BlackButton.vue";
import {ref} from "@vue/reactivity";
import TemplateComponent from "../../components/templates/TemplateComponent.vue";
import {Template} from "../../models/Template";
import LargeModal from "../../components/common/LargeModal.vue";
import {useGetRelativeUrl, useNegativeNavigation, useRelativeNavigation} from "../../composables/navigation";
import {Intent} from "../../models/Form";
import {useModal} from "../../composables/modal";
import TemplateFormComponent from "../../components/templates/TemplateFormComponent.vue";
import {TemplateForm} from "../../composables/template";
import {router} from "@inertiajs/vue3";
import StyledButton from "../../components/StyledButton.vue";
import Modal from "../../components/common/Modal.vue";

defineOptions({layout: ProjectLayout});

const intent = ref<Intent>("add");
const currentTemplate = ref<Template | undefined>();

const props = defineProps<{
    templates: Template[];
    template?: Template
}>();

const show = ref(!!props.template)
function deleteTemplate(template: Template) {
    return router.delete(
        useGetRelativeUrl("/project", `/template/${template.id}`),
        {onSuccess: () => resetPage()}
    );
}

function handleClick(form: TemplateForm) {
    if (currentTemplate.value) {
        return form.put(
            useGetRelativeUrl(
                "/project",
                `/template/${currentTemplate.value.id}`
            ),
            {onSuccess: () => resetPage()}
        );
    }
    return form.post(useGetRelativeUrl("/project", `/template/new`), {
        onSuccess: () => resetPage(),
    });
}




function resetPage() {
    closeModal();
    currentTemplate.value = undefined;
    intent.value = "add";
}
</script>

<style scoped></style>
