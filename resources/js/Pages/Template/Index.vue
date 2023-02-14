<template>
    <Teleport to="body">
        <LargeModal
            :title="intent === 'add' ? `Add Template` : `Edit Template`"
            :show="showModal"
            @close="closeModal"
        >
            <TemplateFormComponent
                :template="currentTemplate"
                @save="(form) => handleClick(form)"
            ></TemplateFormComponent>
        </LargeModal>
    </Teleport>
    <div class="flex py-3 justify-between border-b">
        <PageHeader title="Templates" />
        <BlackButton
            button-text="Add"
            class="rounded ring ring-1 ring-gray-600 text-white bg-black font-inter"
            type="button"
            @click="openModal"
        >
        </BlackButton>
    </div>
    <main class="py-3 space-y-2">
        <TemplateComponent
            @edit="(template) => editTemplate(template)"
            @delete="(template) => deleteTemplate(template)"
            v-for="template in templates"
            :template="template"
        ></TemplateComponent>
    </main>
</template>

<script setup lang="ts">
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import BlackButton from "../../components/common/BlackButton.vue";
import { ref } from "@vue/reactivity";
import TemplateComponent from "../../components/templates/TemplateComponent.vue";
import { Template } from "../../models/Template";
import LargeModal from "../../components/common/LargeModal.vue";
import { useGetRelativeUrl } from "../../composables/navigation";
import { Intent } from "../../models/Form";
import { useModal } from "../../composables/modal";
import TemplateFormComponent from "../../components/templates/TemplateFormComponent.vue";
import { TemplateForm } from "../../composables/template";
import { router } from "@inertiajs/vue3";

defineOptions({ layout: ProjectLayout });
const { showModal, openModal, closeModal } = useModal();

const intent = ref<Intent>("add");
const currentTemplate = ref<Template | undefined>();

const props = defineProps<{
    templates: Template[];
}>();

function editTemplate(template: Template) {
    currentTemplate.value = template;
    openModal();
}

function deleteTemplate(template: Template) {
    return router.delete(
        useGetRelativeUrl("/project", `/template/${template.id}`),
        { onSuccess: () => resetPage() }
    );
}

function handleClick(form: TemplateForm) {
    if (currentTemplate.value) {
        return form.put(
            useGetRelativeUrl(
                "/project",
                `/template/${currentTemplate.value.id}`
            ),
            { onSuccess: () => resetPage() }
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
