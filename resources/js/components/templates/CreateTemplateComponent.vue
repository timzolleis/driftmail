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
import { ref } from "@vue/reactivity";
import { onBeforeMount } from "@vue/runtime-core";

const emit = defineEmits(["success"]);
const form = useTemplateForm();

function saveTemplate() {
    form.post(useGetRelativeUrl("/project", "/templates"), {
        onSuccess: () => emit("success"),
    });
}
</script>
