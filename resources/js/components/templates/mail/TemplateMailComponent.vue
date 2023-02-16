<template>
    <div class="flex flex-col gap-2 overflow-scroll">
        <div class="flex flex-col gap-2">
            <TextInput
                @input="emit('update:modelValue', modelValue)"
                label="Template subject"
                :use-label="true"
                v-model="modelValue.subject"
                :error-message="modelValue.errors.subject"
            ></TextInput>
            <div class="flex items-center gap-1">
                <label
                    class="font-inter text-label-medium text-gray-600"
                    @click="togglePreview"
                >Template Body</label
                >
                <ChevronUpIcon
                    @click="toggleBody"
                    :class="[
                        'stroke-gray-600, h-4 transition-all ease-in-out duration-300',
                        showBody ? 'rotate-180' : '',
                    ]"
                ></ChevronUpIcon>
            </div>
            <Transition name="preview">
                <TextArea
                    v-if="showBody"
                    @input="() => {parseMailBody(); emit('update:modelValue', modelValue)}"
                    label="Template text (insert variables as {variable}, e.g {name}"
                    :use-label="false"
                    v-model="modelValue.body"
                ></TextArea>
            </Transition>
            <div class="flex items-center gap-1">
                <label
                    class="font-inter text-label-medium text-gray-600"
                    @click="togglePreview"
                >Preview</label
                >
                <ChevronUpIcon
                    @click="togglePreview"
                    :class="[
                        'stroke-gray-600, h-4 transition-all ease-in-out duration-300',
                        showPreview ? 'rotate-180' : '',
                    ]"
                ></ChevronUpIcon>
            </div>
            <Transition name="preview">
                <CardContainer v-if="showPreview">
                    <div
                        class="prose-sm prose prose-a:text-blue-500 transition-all ease-in-out duration-300"
                        v-html="markdownValue"
                    ></div>
                </CardContainer>
            </Transition>
        </div>
    </div>
</template>

<script setup lang="ts">
import CardContainer from "../../../Shared/Layout/CardContainer.vue";
import TextInput from "../../form/TextInput.vue";
import TextArea from "../../form/TextArea.vue";
import {computed, ref} from "@vue/reactivity";
import {marked} from "marked";
import ChevronUpIcon from "../../../Shared/icons/ChevronUpIcon.vue";
import {TemplateForm} from "../../../composables/template";
import {onMounted, onUpdated} from "@vue/runtime-core";

function togglePreview() {
    showPreview.value = !showPreview.value;
}

function toggleBody() {
    showBody.value = !showBody.value;
}

const showPreview = ref(false);
const showBody = ref(true);
const props = defineProps<{
    modelValue: TemplateForm;
}>();
const emit = defineEmits(["update:modelValue"]);
const mailBody = ref(props.modelValue.body)



function parseMailBody() {
    mailBody.value = props.modelValue.body.replace(/{[^}]*$/, (match, value) => {
        console.log(match)
        return `<span class="text-red-500">${match}</span>`
    })
    mailBody.value = mailBody.value.replace(/{([^}]*)}/g, (match, value) => {
        return `<span class="text-blue-500">${match}</span>`
    })
}
onMounted(() => parseMailBody())

const markdownValue = computed(() => marked(mailBody.value));
</script>
<style scoped>
.preview-enter-from {
    opacity: 0;
}

.preview-leave-to {
    opacity: 0;
}
</style>
