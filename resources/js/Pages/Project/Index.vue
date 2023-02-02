<template>
    <div class="flex py-3 justify-between border-b">
        <PageHeader :title="project.name" />
    </div>
    <section class="py-5">
        <TextInput
            :error-message="form.errors.name"
            placeholder="My project"
            v-model="form.name"
            :use-label="true"
            label="Project name"
        ></TextInput>
        <TextInput
            :error-message="form.errors.description"
            placeholder="My fancy new project!"
            v-model="form.description"
            :use-label="true"
            label="Project description"
        ></TextInput>
        <BlackButton
            @click="post"
            class="w-full mt-5 py-3"
            button-text="Save"
        ></BlackButton>
    </section>
</template>

<script setup lang="ts">
import PageHeader from "../../Shared/Page/PageHeader.vue";
import { router, useForm } from "@inertiajs/vue3";
import BlackButton from "../../components/common/BlackButton.vue";
import { Project } from "../../models/Project";
import { defineOptions } from "unplugin-vue-define-options/macros";
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import TextInput from "../../components/form/TextInput.vue";

defineOptions({ layout: ProjectLayout });

const props = defineProps<{
    project: Project;
}>();

const form = useForm({
    name: props.project.name,
    description: props.project.description,
});

function post() {
    return form.post(window.location.pathname);
}
</script>

<style scoped></style>
