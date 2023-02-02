<template>
    <div class="flex flex-col gap-2">
        <div class="flex flex-col gap-2">
            <TextInput
                label="Template name"
                :use-label="true"
                v-model="form.name"
                :error-message="form.errors.name"
            ></TextInput>
            <TextInput
                label="Template subject"
                :use-label="true"
                v-model="form.subject"
                :error-message="form.errors.subject"
            ></TextInput>
            <TextArea
                label="Template text (insert variables as {variable}, e.g {name}"
                :use-label="true"
                v-model="form.text"
            ></TextArea>
            <label class="font-inter text-label-medium text-gray-600"
                >Preview</label
            >
            <CardContainer>
                <div
                    class="prose-sm prose prose-a:text-blue-500"
                    v-html="markdownValue"
                ></div>
            </CardContainer>
        </div>
    </div>
</template>

<script setup lang="ts">
import CardContainer from "../../../Shared/Layout/CardContainer.vue";
import TextInput from "../../form/TextInput.vue";
import TextArea from "../../form/TextArea.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps<{
    form: typeof useForm;
}>();
const emit = defineEmits(["update:form"]);
</script>
