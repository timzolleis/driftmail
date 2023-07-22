<template>
        <Listbox
            class="scrollbar-hide"
            :value="modelValue"
            @update:model-value="(value) => emit('update:modelValue', value)"
        >
            <div class="relative mt-1">
                <ListboxButton
                    class="flex h-9 w-full items-center justify-between rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50"
                >

                        <p class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-2 pr-8 text-sm outline-none focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50">{{
                            modelValue.name
                        }}</p>
                    <span
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                    >
                        <ChevronUpDownIcon
                            class="stroke-gray-400"
                        ></ChevronUpDownIcon>
                    </span>
                </ListboxButton>

                <transition
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <ListboxOptions
                        class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                    >
                        <ListboxOption
                            v-slot="{ active, selected }"
                            v-for="scope in scopes"
                            :key="scope.name"
                            :value="scope"
                            as="template"
                        >
                            <li
                                :class="[
                                    active
                                        ? 'bg-gray-100 text-black'
                                        : 'text-gray-800',
                                    'relative cursor-default select-none py-2 px-4 divide-y',
                                ]"
                            >
                                <div class="flex items-center gap-2">
                                    <p class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-2 pr-8 text-sm outline-none focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                                        :class="[
                                            selected
                                                ? 'font-medium'
                                                : 'font-normal',
                                            'block truncate',
                                        ]"
                                    >
                                        {{ scope.name }}</p
                                    >
                                    <CheckIcon
                                        class="h-4 w-4"
                                        v-if="modelValue.name === scope.name"
                                    ></CheckIcon>
                                </div>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </div>
        </Listbox>
</template>

<script setup lang="ts">
import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";
import { SelectOption } from "../../models/Select";
import GlobeIcon from "../../Shared/icons/GlobeIcon.vue";
import UserIcon from "../../Shared/icons/UserIcon.vue";
import CheckIcon from "../../Shared/icons/CheckIcon.vue";
import ChevronUpDownIcon from "../../Shared/icons/ChevronUpDownIcon.vue";

const props = defineProps<{
    modelValue: SelectOption;
    scopes: SelectOption[];
}>();
const emit = defineEmits(["update:modelValue"]);
</script>
