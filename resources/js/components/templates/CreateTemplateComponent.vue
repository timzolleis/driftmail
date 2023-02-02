<template>
    <div class="w-full font-inter px-10">
        <TabGroup>
            <TabList class="w-full flex space-x-1 rounded-xl py-3">
                <Tab v-slot="{ selected }" class="w-full">
                    <button
                        :class="[
                            'w-full rounded-lg py-2.5 text-sm font-medium leading-5',
                            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            selected
                                ? 'bg-black text-white shadow-md'
                                : 'border border-black',
                        ]"
                    >
                        General
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" class="w-full">
                    <button
                        :class="[
                            'w-full rounded-lg py-2.5 text-sm font-medium leading-5',
                            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            selected
                                ? 'bg-black text-white shadow-md'
                                : 'border border-black/50 text-black',
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
                            v-model="generalForm.name"
                            :error-message="generalForm.errors.name"
                        ></TextInput>
                        <TextArea
                            label="Template description"
                            :use-label="true"
                            v-model="generalForm.description"
                            :error-message="generalForm.errors.description"
                        ></TextArea>
                    </div>
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>

<style scoped></style>
<script setup lang="ts">
import TextArea from "../form/TextArea.vue";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import TextInput from "../form/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { string } from "postcss-selector-parser";

const generalForm = useForm({
    name: "",
    description: "",
});
</script>
