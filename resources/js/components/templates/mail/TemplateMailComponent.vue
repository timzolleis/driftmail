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
                    ref="testRef"
                    v-if="showBody"
                    @input="
                        () => {
                            parseMailBody();
                            emit('update:modelValue', modelValue);
                        }
                    "
                    label="Template text (insert variables as {variable}, e.g {name}"
                    :use-label="false"
                    v-model="modelValue.body"
                ></TextArea>
            </Transition>
            <div class="flex items-center gap-1">
                <label class="font-inter text-label-medium text-gray-600"
                    >Suggested Variables</label
                >
            </div>
            <VariableAutoCompleteComponent
                @insert="(variableName) => insertVariable(variableName)"
                id="autocomplete"
                v-if="searchResults.length > 0"
                :variables="searchResults"
            ></VariableAutoCompleteComponent>
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
import { computed, ref } from "@vue/reactivity";
import { marked } from "marked";
import ChevronUpIcon from "../../../Shared/icons/ChevronUpIcon.vue";
import { TemplateForm } from "../../../composables/template";
import { onMounted, onUpdated, watch } from "@vue/runtime-core";
import axios from "axios";
import { useGetRelativeUrl } from "../../../composables/navigation";
import VariableAutoCompleteComponent from "./VariableAutoCompleteComponent.vue";
import { Variable } from "../../../models/Variable";
import { useDebounce } from "../../../composables/debounce";
import { moduleExpression } from "@babel/types";

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
const searchResults = ref<Variable[]>([]);
const mailBody = ref(props.modelValue.body);
const testRef = ref();
onMounted(() => {
    parseMailBody();
});
const markdownValue = computed(() => marked(mailBody.value));
const debounce = useDebounce();

const VARIABLE_MATCH_REGEX = /{[^\s}]*(?![^\s}]*\})\S/;
const OPEN_BRACKET_MATCH_REGEX = /{(?!\s*\S.*\})/;

const variableMatch = computed(() =>
    props.modelValue.body.match(VARIABLE_MATCH_REGEX)
);

const openBracketMatch = computed(() =>
    props.modelValue.body.match(OPEN_BRACKET_MATCH_REGEX)
);

function searchVariables(query: string) {
    axios
        .get(useGetRelativeUrl("/project", "/variable/search"), {
            params: {
                query: query.replace(/[{}/]/g, ""),
            },
        })
        .then((res) => {
            if (variableMatch.value || openBracketMatch.value) {
                searchResults.value = res.data;
            } else searchResults.value = [];
        });
}

function insertVariable(variableName: string) {
    let hasReplaced = false;
    if (variableMatch.value) {
        hasReplaced = true;
        props.modelValue.body = props.modelValue.body.replace(
            VARIABLE_MATCH_REGEX,
            `{${variableName}}`
        );
    }
    if (!hasReplaced) {
        props.modelValue.body = props.modelValue.body.replace(
            OPEN_BRACKET_MATCH_REGEX,
            `{${variableName}}`
        );
    }

    emit("update:modelValue", props.modelValue);
}

function parseMailBody() {
    if (variableMatch.value !== null) {
        debounce(() => searchVariables(variableMatch.value[0]), 350);
    }
    if (openBracketMatch.value && !variableMatch.value) {
        debounce(() => searchVariables(" "), 350);
    }
    if (!openBracketMatch.value && !variableMatch.value) {
        searchResults.value = [];
    }
    mailBody.value = props.modelValue.body.replace(
        VARIABLE_MATCH_REGEX,
        (match) => {
            return `<span class="text-red-500">${match}</span>`;
        }
    );
    mailBody.value = mailBody.value.replace(/{([^}]*)}/g, (match) => {
        return `<span class="text-blue-500">${match}</span>`;
    });
}
</script>
<style scoped>
.preview-enter-from {
    opacity: 0;
}

.preview-leave-to {
    opacity: 0;
}
</style>
