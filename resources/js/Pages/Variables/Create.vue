<template>
    <div class="space-y-4">
        <PageHeader title="New Variable"/>
        <form @submit.prevent="postForm">
            <main class="space-y-2">
                <section class="space-y-2">
                    <p class="font-inter text-gray-800 font-medium text-title-small">General</p>
                    <CardContainer>
                        <div class="flex flex-col gap-2">
                            <TextInput label="Variable key (key to search the text for)" :use-label="true" v-model="form.key"
                                       :error-message="form.errors.key"></TextInput>
                            <TextInput label="Variable value (key to search in the provided variables object)" :use-label="true" v-model="form.value"
                                       :error-message="form.errors.value"></TextInput>
                            <TextArea label="Variable description " :use-label="true"
                                      v-model="form.description"></TextArea>
                            <CheckBox  v-model="form.isGlobal" label="Is global" :use-label="true"></CheckBox>
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
import CheckBox from "../../components/form/CheckBox.vue";

const form = useForm({
    key: "",
    value: "",
    description: "",
    isGlobal: false,

})

function postForm() {
    form.post('/variable/new')
}

</script>

<style scoped>

</style>
