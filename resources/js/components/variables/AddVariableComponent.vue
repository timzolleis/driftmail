<template>
    <VariableFormComponent></VariableFormComponent>
</template>

<script setup lang="ts">
import { useForm, usePage } from "@inertiajs/vue3";
import { Project } from "../../models/Project";
import { scopes } from "../../config/props";
import VariableFormComponent from "./VariableFormComponent.vue";

const props = defineProps<{
    project: Project;
}>();
const form = useForm({
    key: "",
    value: "",
    description: "",
    scope: scopes[0],
});
const emit = defineEmits(["success"]);

function postForm() {
    form.post(`/project/${props.project.id}/variable/new`, {
        onSuccess: () => emit("success"),
    });
}
</script>

<style scoped></style>
