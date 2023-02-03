<template></template>

<style scoped></style>
<script setup lang="ts">
import TextArea from "../form/TextArea.vue";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import TextInput from "../form/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { string } from "postcss-selector-parser";
import BlackButton from "../common/BlackButton.vue";
import MailTemplateComponent from "./mail/MailTemplateComponent.vue";
import { useGetRelativeUrl } from "../../composables/navigation";

const form = useForm({
    name: "",
    description: "",
    subject: "",
    body: "",
});

function saveTemplate() {
    form.post(useGetRelativeUrl("/project", "/templates"));
}
</script>
