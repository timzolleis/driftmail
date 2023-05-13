<script setup lang="ts">
import {Template} from "../../models/Template";
import {defineOptions} from "unplugin-vue-define-options/macros";
import TextArea from "../../components/form/TextArea.vue";
import TextInput from "../../components/form/TextInput.vue";
import {useTemplateForm} from "../../composables/template";
import Label from "../../components/Label.vue";
import EditTemplateLayout from "./EditTemplateLayout.vue";
import Modal from "../../components/common/Modal.vue";
import {computed, ref} from "@vue/reactivity";
import Select from "../../components/Select.vue";
import AddVariable from "../../components/templates/AddVariable.vue";
import AddLink from "../../components/templates/AddLink.vue";
import {marked} from "marked";
import CardContainer from "../../Shared/Layout/CardContainer.vue";
import {onMounted} from "@vue/runtime-core";
import StyledButton from "../../components/StyledButton.vue";
import {useNegativeNavigation} from "../../composables/navigation";
import {Eye, EyeOff} from "lucide-vue-next";

defineOptions({layout: EditTemplateLayout});
const props = defineProps<{ template: Template }>()
const form = useTemplateForm(props.template)
const showModal = ref(false)
const showPreview = ref(true)
const selectOptions = [
    {
        name: "Link",
        value: "link"
    },
    {
        name: "Variable",
        value: "variable"
    }
]
const selectedOption = ref(selectOptions[0])
const markdownValue = computed(() => marked(form.body));

function insertIntoMailBody(text: string) {
    const element = document.getElementById("textarea") as HTMLTextAreaElement
    const [start, end] = [element.selectionStart, element.selectionEnd]
    const slicedTextStart = form.body.slice(0, start)
    const slicedTextEnd = form.body.slice(end)
    form.body = slicedTextStart + text + slicedTextEnd
}

onMounted(() => {
})
</script>

<template>
    <form class="w-full pb-5">
        <Teleport to="body">
            <Modal title="Add markdown element" :show="showModal" @close="showModal = false">
                <Select v-model="selectedOption" :options="selectOptions"></Select>
                <div class="mt-5 px-1">
                    <AddVariable @insert="(value) => {
                        showModal = false
                        insertIntoMailBody(value)
                    }" v-if="selectedOption.value === 'variable'"></AddVariable>
                    <AddLink @insert="(value) => {
                        showModal = false
                        insertIntoMailBody(value)
                    }" v-if="selectedOption.value === 'link'"></AddLink>
                </div>
            </Modal>
        </Teleport>
        <div class="">

            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <Label>Email subject</Label>
                    <TextInput v-model="form.subject"></TextInput>
                </div>
                <div class="col-span-full">
                    <div class="flex items-center gap-2">
                        <Label>Email body</Label>
                        <button type="button"
                                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                                @click="showModal = true">Add element
                        </button>
                    </div>
                    <TextArea class="mt-2" v-model="form.body"></TextArea>
                    <div class="flex justify-end">
                    </div>
                </div>
                <div class="col-span-full">
                   <div class="flex items-center gap-2">
                       <Label>Preview</Label>
                       <Eye @click="showPreview = true" v-if="!showPreview" class="stroke-gray-900 stroke-1" size="20"></Eye>
                       <EyeOff @click="showPreview = false" v-if="showPreview" class="stroke-gray-900 stroke-1" size="20"></EyeOff>
                   </div>
                    <CardContainer v-if="showPreview">
                        <div
                            class="prose-sm prose prose-a:text-blue-500 transition-all ease-in-out duration-300"
                            v-html="markdownValue"
                        ></div>
                    </CardContainer>
                </div>
            </div>
        </div>
      <div class="mt-2 flex justify-end">
          <StyledButton @click="form.put(useNegativeNavigation(1))">Save</StyledButton>
      </div>
    </form>

</template>

<style scoped>

</style>
