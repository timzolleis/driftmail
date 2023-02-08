<template>
    <section class="md:p-5">
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
            @click="emit('save')"
            class="w-full mt-5 py-3"
            button-text="Add Variable"
        ></BlackButton>
    </section>
</template>

<script setup lang="ts">
import BlackButton from "../common/BlackButton.vue";
import SelectVariableScopeComponent from "./SelectVariableScopeComponent.vue";
import TextArea from "../form/TextArea.vue";
import TextInput from "../form/TextInput.vue";
import { Variable } from "../../models/Variable";
import { useVariableForm } from "../../composables/variable";
import { scopes } from "../../config/props";
const props = defineProps<{
    variable?: Variable;
}>();

const form = useVariableForm(props.variable);
const emit = defineEmits(["save"]);
</script>

<style scoped></style>
