<template>
    <section class="py-2">
        <Label
            >Variable scope</Label
        >
        <Listbox
            :value="modelValue"
            @update:model-value="(value) => emit('update:modelValue', value)"
        >
            <div class="relative mt-1">
                <ListboxButton
                    class="block w-full rounded-md border border-gray-200 bg-white p-2 px-3 text-sm shadow-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                >
                    <span class="flex items-center gap-2">
                        <span>
                            <GlobeIcon
                                class="stroke-violet-400"
                                v-if="modelValue.id.includes('global')"
                            ></GlobeIcon>
                            <UserIcon
                                class="stroke-fuchsia-400"
                                v-if="modelValue.id.includes('user')"
                            >
                            </UserIcon>
                        </span>
                        <span class="block truncate">{{
                            modelValue.name
                        }}</span>
                    </span>
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
                                <span class="flex items-center gap-2">
                                    <span>
                                        <GlobeIcon
                                            class="stroke-violet-400"
                                            v-if="scope.id.includes('global')"
                                        ></GlobeIcon>
                                        <UserIcon
                                            class="stroke-fuchsia-400"
                                            v-if="scope.id.includes('user')"
                                        >
                                        </UserIcon>
                                    </span>
                                    <span
                                        :class="[
                                            selected
                                                ? 'font-medium'
                                                : 'font-normal',
                                            'block truncate',
                                        ]"
                                    >
                                        {{ scope.name }}</span
                                    >
                                    <CheckIcon
                                        class="stroke-green-500 h-4"
                                        v-if="modelValue.name === scope.name"
                                    ></CheckIcon>
                                </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </div>
        </Listbox>
    </section>
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
import Label from "../Label.vue";

const props = defineProps<{
    modelValue: SelectOption;
    scopes: SelectOption[];
}>();
const emit = defineEmits(["update:modelValue"]);
</script>
