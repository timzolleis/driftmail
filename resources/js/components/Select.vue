<script setup lang="ts">

import {Listbox, ListboxButton, ListboxOption, ListboxOptions} from "@headlessui/vue";
import {ChevronsUpDown} from "lucide-vue-next";
import {Check} from "lucide-vue-next";
type Option = {
    name: string,
    value: string
}
const props = defineProps<{
    options: Option[],
    modelValue: Option
}>()
</script>

<template>
    <Listbox :model-value="modelValue" @update:model-value="(value) => $emit('update:modelValue', value)">
        <div class="relative mt-1">
            <ListboxButton
                class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-transparent px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            >
                <span class="block truncate">{{ modelValue.name }}</span>
                <span
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                >
            <ChevronsUpDown
                class="h-5 w-5 text-gray-400"
                aria-hidden="true"
            />
          </span>
            </ListboxButton>

            <transition
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <ListboxOptions
                    class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white  text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                >
                    <ListboxOption
                        v-slot="{ active, selected }"
                        v-for="option in options"
                        :key="option.name"
                        :value="option"
                        as="template"
                    >
                        <li
                            class="relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 hover:bg-accent"
                        >
                <span
                    :class="[
                    selected ? 'font-medium' : 'font-normal',
                    'block truncate',
                  ]"
                >{{ option.name }}</span
                >
                            <span
                                v-if="selected"
                                class="absolute inset-y-0 left-0 flex items-center pl-3 "
                            >
                  <Check size="14" aria-hidden="true"/>
                </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>

<style scoped>

</style>
