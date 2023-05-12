<template>
       <div>
           <div class="grid md:grid-cols-2 gap-x-2">
               <TextInput
                   :error-message="modelValue.errors.key"
                   placeholder="Event title"
                   v-model="modelValue.key"
                   :use-label="true"
                   label="Variable key"
               ></TextInput>
               <TextInput
                   :error-message="modelValue.errors.value"
                   placeholder="event.title"
                   v-model="modelValue.value"
                   :use-label="true"
                   label="Variable value"
               ></TextInput>
           </div>
           <TextArea
               :error-message="modelValue.errors.description"
               placeholder="This variable is for setting the event title in the subject of the invitation"
               v-model="modelValue.description"
               :use-label="true"
               label="Variable description"
           ></TextArea>
           <SelectVariableScopeComponent
               v-model="modelValue.scope"
               :scopes="scopes"
           ></SelectVariableScopeComponent>
       </div>
</template>

<script setup lang="ts">
import SelectVariableScopeComponent from "./SelectVariableScopeComponent.vue";
import TextArea from "../form/TextArea.vue";
import TextInput from "../form/TextInput.vue";
import {VariableForm} from "../../composables/variable";
import {scopes} from "../../config/props";

const props = defineProps<{
    modelValue: VariableForm,
    intent: string;
}>();

const emit = defineEmits(["save, update:modelValue"]);
</script>

<style scoped></style>
