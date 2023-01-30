<template>
    <div class="space-y-4">
        <PageHeader title="Edit Template"/>
        <form @submit.prevent="postForm">
            <main class="space-y-2">
                <section class="space-y-2">
                    <p class="font-inter text-gray-800 font-medium text-title-small">General</p>
                    <CardContainer>
                        <div class="flex flex-col gap-2">
                            <TextInput label="Template name" :use-label="true" v-model="form.name"
                                       :error-message="form.errors.name"></TextInput>
                            <TextInput label="Template subject" :use-label="true" v-model="form.subject"
                                       :error-message="form.errors.subject"></TextInput>
                            <TextArea label="Template text (insert variables as {variable}, e.g {name}"
                                      :use-label="true"
                                      v-model="form.text"></TextArea>
                        </div>
                    </CardContainer>
                </section>
            </main>
            <section class="w-full flex justify-end mt-3">
                <div class="flex gap-2 items-center">
                    <BlackButton  button-text="Delete" type="button" @click="router.delete(`/template/${template.id}`)"
                            class="bg-white border-red-500 font-inter text-red-500">Delete
                    </BlackButton>
                    <BlackButton button-text="Save" type="submit"></BlackButton>
                    <BlackButton class="bg-white text-black" button-text="Cancel" type="button" @click="router.get('/')">
                    </BlackButton>
                </div>
            </section>
        </form>

    </div>
</template>

<script lang="ts">
import AuthenticatedLayout from "../../Shared/Layout/AuthenticatedLayout.vue";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import CardContainer from "../../Shared/Layout/CardContainer.vue";
import TextInput from "../../components/form/TextInput.vue";

export default {
    name: "Edit",
    components: {TextInput, CardContainer, PageHeader},
    layout: AuthenticatedLayout
}
</script>

<script setup lang="ts">
import {router, useForm} from "@inertiajs/vue3";
import TextArea from "../../components/form/TextArea.vue";
import CheckBox from "../../components/form/CheckBox.vue";
import {Variable} from "../../models/Variable";
import {Template} from "../../models/Template";
import BlackButton from "../../components/common/BlackButton.vue";

const props = defineProps<{
    template: Template
}>()
const form = useForm({
    name: props.template.name,
    subject: props.template.subject,
    text: props.template.text

})

function postForm() {
    form.put(`/template/${props.template.id}`)
}

</script>

<style scoped>

</style>
