<script setup lang="ts">



import {Listbox, ListboxButton, ListboxOption, ListboxOptions} from "@headlessui/vue";

const props = defineProps<{

}>()


</script>

<template>
    <Listbox v-model="selectedPerson">
        <ListboxButton>{{ selectedPerson.name }}</ListboxButton>
        <ListboxOptions>
            <ListboxOption
                v-for="person in people"
                :key="person.id"
                :value="person"
                :disabled="person.unavailable"
            >
                {{ person.name }}
            </ListboxOption>
        </ListboxOptions>
    </Listbox>
</template>

<style scoped>

</style>
