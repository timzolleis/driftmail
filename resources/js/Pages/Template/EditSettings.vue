<script setup lang="ts">
import {Template} from "../../models/Template";
import {defineOptions} from "unplugin-vue-define-options/macros";
import TextArea from "../../components/form/TextArea.vue";
import TextInput from "../../components/form/TextInput.vue";
import {useTemplateForm} from "../../composables/template";
import Label from "../../components/Label.vue";
import StyledButton from "../../components/StyledButton.vue";
import EditTemplateLayout from "./EditTemplateLayout.vue";
import {useNegativeNavigation} from "../../composables/navigation";
import {Head} from "@inertiajs/vue3"
defineOptions({layout: EditTemplateLayout});
const props = defineProps<{ template: Template }>()
const form = useTemplateForm(props.template)
</script>

<template>
    <Head >
        <title>Edit template - driftmail</title>
    </Head>
    <form class="w-full">
        <div class="">
            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <Label>Template name</Label>
                    <TextInput v-model="form.name"></TextInput>
                </div>
                <div class="col-span-full">
                    <Label for="about">Template description</Label>
                    <div class="mt-2">
                        <TextArea v-model="form.description"></TextArea>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-5">
                <StyledButton @click="form.put(useNegativeNavigation(1))">Save</StyledButton>
            </div>
        </div>
    </form>

</template>

<style scoped>

</style>
