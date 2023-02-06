<template>
    <section class="p-5">
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
            @click="postForm"
            class="w-full mt-5 py-3"
            button-text="Add Project"
        ></BlackButton>
    </section>
</template>

<script setup lang="ts">
import TextInput from "../form/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import BlackButton from "../common/BlackButton.vue";

const form = useForm({
    name: "",
    description: "",
});

const emit = defineEmits(["success"]);

function postForm() {
    form.post("/project/new");
}
</script>

<style scoped></style>
