<template>
    <TemplateFormComponent
        v-model="form"
        type="edit"
        @save="saveTemplate"
    ></TemplateFormComponent>
</template>

<script setup lang="ts">
import { Template } from "../../models/Template";
import TemplateFormComponent from "./TemplateFormComponent.vue";
import { useTemplateForm } from "../../composables/template";
import { useGetRelativeUrl } from "../../composables/navigation";

const props = defineProps<{
    template: Template;
}>();

const form = useTemplateForm(props.template);
const emit = defineEmits(["success"]);

function saveTemplate() {
    return form.put(
        useGetRelativeUrl("/project", `/template/${props.template.id}`),
        {
            onSuccess: () => emit("success"),
        }
    );
}
</script>

<style scoped></style>
