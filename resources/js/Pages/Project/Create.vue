<template>
    <div class="space-y-4">
        <PageHeader title="New Project"/>
        <form @submit.prevent="postForm">
            <main class="space-y-2">
                <section class="space-y-2">
                    <p class="font-inter text-gray-800 font-medium text-title-small">General</p>
                    <CardContainer>
                        <div class="flex flex-col gap-2">
                            <TextInput label="Project name" :use-label="true" v-model="form.name"
                                       :error-message="form.errors.name"></TextInput>
                            <TextArea label="Project description" :use-label="true"
                                      v-model="form.description"></TextArea>
                        </div>
                    </CardContainer>
                </section>
                <section class="space-y-2">
                    <p class="font-inter text-gray-800 font-medium text-title-small">Configuration</p>
                    <CardContainer>
                        <div class="flex flex-col gap-2">
                            <div class="flex gap-2 items-end">
                                <TextInput label="Api Key" :use-label="true"
                                           v-model="form.apiKey"
                                           :error-message="form.errors.apiKey"></TextInput>
                                <button type="button" @click="generateApiKey"
                                        class="p-2 bg-black text-white text-label-medium font-inter rounded font-medium">
                                    Generate
                                </button>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <TextInput label="Mail host" :use-label="true"
                                               v-model="form.mailHost"
                                               :error-message="form.errors.mailHost"></TextInput>
                                </div>
                                <TextInput label="Mail port" :use-label="true"
                                           v-model="form.mailPort"
                                           :error-message="form.errors.mailPort"></TextInput>
                                <TextInput label="Mail user" :use-label="true"
                                           v-model="form.mailUser"
                                           :error-message="form.errors.mailUser"></TextInput>
                                <TextInput label="Mail password" :use-label="true"
                                           v-model="form.mailPassword"
                                           :error-message="form.errors.mailUser"></TextInput>
                                <TextInput label="Mail sending address" :use-label="true"
                                           v-model="form.mailSendingAddress"
                                           :error-message="form.errors.mailSendingAddress"></TextInput>
                                <TextInput label="TestMail receiver" :use-label="true"
                                           v-model="form.mailTestReceiver"
                                           :error-message="form.errors.mailTestReceiver"></TextInput>
                            </div>
                        </div>
                    </CardContainer>
                </section>
            </main>
            <section class="w-full flex justify-end mt-3">
                <div class="flex gap-2 items-center">
                    <button type="submit" class="px-5 py-2 rounded bg-black font-inter text-white">Save</button>
                    <button type="button" @click="router.get('/')"
                            class="px-5 py-2 rounded ring ring-1 ring-black font-inter">Cancel
                    </button>
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
    name: "Create",
    components: {TextInput, CardContainer, PageHeader},
    layout: AuthenticatedLayout
}
</script>

<script setup lang="ts">
import {router, useForm} from "@inertiajs/vue3";
import TextArea from "../../components/form/TextArea.vue";
import {useApiKey} from "../../composables/key";
import {RequestPayload} from "@inertiajs/core";

function generateApiKey() {
    form.apiKey = useApiKey();
}

const form = useForm({
    name: "My new Project",
    description: "This is a fancy new project!",
    apiKey: useApiKey(),
    mailSendingAddress: "",
    mailUser: "",
    mailHost: "",
    mailPort: "",
    mailPassword: "",
    mailTestReceiver: ""
})
console.log(form.errors)

function postForm() {
    form.post('/project/new')
}

</script>

<style scoped>

</style>
