<template>
    <section class="p-5">
        <TextInput :error-message="form.errors.key" placeholder="Event title" v-model="form.key" :use-label="true"
                   label="Variable key"></TextInput>
        <TextInput :error-message="form.errors.value" placeholder="event.title" v-model="form.value" :use-label="true"
                   label="Variable value"></TextInput>
        <TextArea :error-message="form.errors.description"
                  placeholder="This variable is for setting the event title in the subject of the invitation"
                  v-model="form.description" :use-label="true" label="Variable description"></TextArea>
        <BlackButton @click="postForm" class="w-full mt-5 py-3" button-text="Add Variable"></BlackButton>
    </section>

    <div>
        <Listbox v-model="form.scope">
            <div class="relative mt-1">
                <ListboxButton
                    class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 pr-10 text-left shadow-md focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
                >
                    <span class="block truncate">Scope</span>
                    <span
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                    >
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
                            :key="scope"
                            :value="scope"
                            as="template"
                        >
                            <li
                                :class="[
                  active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                  'relative cursor-default select-none py-2 pl-10 pr-4',
                ]"
                            >
                <span
                    :class="[
                    selected ? 'font-medium' : 'font-normal',
                    'block truncate',
                  ]"
                >{{ scope }}</span
                >
                                <span
                                    v-if="selected"
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                >
                </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </div>
        </Listbox>
    </div>
</template>

<script setup lang="ts">

import TextInput from "../form/TextInput.vue";
import BlackButton from "../common/BlackButton.vue";
import {useForm} from "@inertiajs/vue3";
import TextArea from "../form/TextArea.vue";
import {Listbox, ListboxButton, ListboxOption, ListboxOptions} from "@headlessui/vue";

const form = useForm({
    key: "",
    value: "",
    description: "",
    scope: "local"
})
const emit = defineEmits(['success']);


const scopes = ["Global - All", "Global - Subject", "Global - Text", 'User - All', 'User - Subject', 'User - Text']

function postForm() {
    form.post('/variable/new', {
        onSuccess: () => emit('success')
    })
}


</script>

<style scoped>

</style>
