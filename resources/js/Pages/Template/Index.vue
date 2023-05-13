<template>
    <div>

        <div class="flex py-3 justify-between border-b">
            <PageHeader>Templates</PageHeader>
            <StyledButton
                type="button"
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
import {ref} from "@vue/reactivity";
import TemplateComponent from "../../components/templates/TemplateComponent.vue";
import {Template} from "../../models/Template";
import {useGetRelativeUrl} from "../../composables/navigation";
import {Intent} from "../../models/Form";
import {TemplateForm, useTemplateForm} from "../../composables/template";
import {router} from "@inertiajs/vue3";
import StyledButton from "../../components/StyledButton.vue";

defineOptions({layout: ProjectLayout});

const intent = ref<Intent>("add");
const currentTemplate = ref<Template | undefined>();

const props = defineProps<{
    templates: Template[];
    template?: Template
}>();

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
const form = useTemplateForm(props.template)





function resetPage() {
    closeModal();
    currentTemplate.value = undefined;
    intent.value = "add";
}
</script>

<style scoped></style>
