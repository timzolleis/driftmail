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
            <div class="flex items-center gap-1" @click="showBody = !showBody">
                <label
                    class="font-inter text-label-medium text-gray-600"
                    >Template Body</label
                >
                <ChevronUpIcon
                    :class="[
                        'stroke-gray-600, h-4 transition-all ease-in-out duration-300',
                        showBody ? 'rotate-180' : '',
                    ]"
                ></ChevronUpIcon>
            </div>
            <Transition name="preview">
                <TextArea
                    ref="testRef"
                    v-if="showBody"
                    @input="
                        () => {
                            emit('update:modelValue', templateForm);
                        }
                    "
                    label="Template text (insert variables as {variable}, e.g {name}"
                    :use-label="false"
                    v-model="templateForm.body"
                ></TextArea>
            </Transition>
            <div class="flex items-center gap-1">
                <label class="font-inter text-label-medium text-gray-600"
                    >Suggested Variables</label
                >
            </div>
            <div class="flex items-center gap-1"  @click="showPreview = !showPreview">
                <label
                    class="font-inter text-label-medium text-gray-600"
                    >Preview</label
                >
                <ChevronUpIcon

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
import {useDebounce} from "../../../composables/debounce";

const showPreview = ref(false);
const showBody = ref(true);
const props = defineProps<{
    templateForm: TemplateForm;
}>();
const emit = defineEmits(["update:modelValue"]);
const mailBody = ref(props.templateForm.body);
const markdownValue = computed(() => marked(mailBody.value));
const debounce = useDebounce();

</script>
<style scoped>
.preview-enter-from {
    opacity: 0;
}

.preview-leave-to {
    opacity: 0;
}
</style>
