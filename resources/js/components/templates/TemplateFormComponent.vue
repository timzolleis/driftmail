<template>
    <div class="w-full">
        <TabGroup>
            <TabList class="w-full flex rounded-xl py-3">
                <Tab v-slot="{ selected }" class="w-full">
                    <button
                        :class="[
                            'w-full py-1.5 text-sm font-medium leading-5',
                            selected
                                ? 'border-b border-black'
                                : 'border-b border-gray-200',
                        ]"
                    >
                        General
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" class="w-full">
                    <button
                        :class="[
                            'w-full py-1.5 text-sm font-medium leading-5 outline-none',
                            selected
                                ? 'border-b border-black '
                                : 'border-b border-gray-200',
                        ]"
                    >
                        Mail templating
                    </button>
                </Tab>
            </TabList>

            <TabPanels class="mt-2">
                <TabPanel
                    :class="[
                        'rounded-xl',
                        'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none',
                    ]"
                >
                    <div class="flex flex-col gap-2">
                        <TextInput
                            label="Template name"
                            :use-label="true"
                            v-model="modelValue.name"
                            :error-message="modelValue.errors.name"
                        ></TextInput>
                        <TextArea
                            label="Template description"
                            :use-label="true"
                            v-model="modelValue.description"
                            :error-message="modelValue.errors.description"
                        ></TextArea>
                    </div>
                </TabPanel>
                <TabPanel
                    :class="[
                        'rounded-xl',
                        'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none',
                    ]"
                >
                    <TemplateMailComponent  v-bind="modelValue">
                        >
                    </TemplateMailComponent>
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>
>

<style scoped></style>
<script setup lang="ts">
//TODO: Rework Mail Component
import TextArea from "../form/TextArea.vue";
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";
import TextInput from "../form/TextInput.vue";
import {Template} from "../../models/Template";
import TemplateMailComponent from "./mail/TemplateMailComponent.vue";
import {TemplateForm} from "../../composables/template";
import {watch} from "@vue/runtime-core";

const props = defineProps<{
    modelValue: TemplateForm;
}>();




const emit = defineEmits(["update:modelValue"]);
</script>
