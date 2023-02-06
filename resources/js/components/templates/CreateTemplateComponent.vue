<template>
    <TemplateFormComponent
        v-model="form"
        type="create"
        @save="saveTemplate"
    ></TemplateFormComponent>
</template>

<style scoped></style>
<script setup lang="ts">
import { useGetRelativeUrl } from "../../composables/navigation";
import TemplateFormComponent from "./TemplateFormComponent.vue";
import { useTemplateForm } from "../../composables/template";
import { useForm } from "@inertiajs/vue3";

const emit = defineEmits(["success"]);
const form = useForm({
    name: "",
    description: "",
    subject: "",
    body: "",
});

function saveTemplate() {
    form.post(useGetRelativeUrl("/project", "/templates"), {
        onSuccess: () => emit("success"),
    });
}
</script>
