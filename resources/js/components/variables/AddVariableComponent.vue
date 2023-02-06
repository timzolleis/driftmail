<template>
    <section class="p-5">
        <TextInput
            :error-message="form.errors.key"
            placeholder="Event title"
            v-model="form.key"
            :use-label="true"
            label="Variable key"
        ></TextInput>
        <TextInput
            :error-message="form.errors.value"
            placeholder="event.title"
            v-model="form.value"
            :use-label="true"
            label="Variable value"
        ></TextInput>
        <TextArea
            :error-message="form.errors.description"
            placeholder="This variable is for setting the event title in the subject of the invitation"
            v-model="form.description"
            :use-label="true"
            label="Variable description"
        ></TextArea>
        <SelectVariableScopeComponent
            v-model="form.scope"
            :scopes="scopes"
        ></SelectVariableScopeComponent>

        <BlackButton
            @click="postForm"
            class="w-full mt-5 py-3"
            button-text="Add Variable"
        ></BlackButton>
    </section>
</template>

<script setup lang="ts">
import TextInput from "../form/TextInput.vue";
import BlackButton from "../common/BlackButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import TextArea from "../form/TextArea.vue";
import SelectVariableScopeComponent from "./SelectVariableScopeComponent.vue";
import { Project } from "../../models/Project";
import { scopes } from "../../config/props";
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
    form.post(`/project/${props.project.id}/variable/new`);
}
</script>

<style scoped></style>
