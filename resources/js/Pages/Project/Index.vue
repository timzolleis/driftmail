<template>
    <div class="flex py-3 justify-between border-b">
        <PageHeader>{{project.name}}</PageHeader>
    </div>
          <section class="py-5 grid md:grid-cols-2 gap-x-2">
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
          </section>
          <div class="flex items-center gap-2 justify-end">
              <StyledButton :loading="form.processing" @click="post">{{form.processing ? "Saving" : "Save"}}</StyledButton>
          </div>
</template>

<script setup lang="ts">
import PageHeader from "../../Shared/Page/PageHeader.vue";
import { router, useForm } from "@inertiajs/vue3";
import BlackButton from "../../components/common/BlackButton.vue";
import { Project } from "../../models/Project";
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import TextInput from "../../components/form/TextInput.vue";
import {useGetRelativeUrl, useRelativeNavigation} from "../../composables/navigation";
import StyledButton from "../../components/StyledButton.vue";

defineOptions({ layout: ProjectLayout });

const props = defineProps<{
    project: Project;
}>();

const form = useForm({
    name: props.project.name,
    description: props.project.description,
});

function post() {
    form.put(window.location.pathname);
}
</script>

<style scoped></style>
