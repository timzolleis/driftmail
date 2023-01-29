<template>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="border-b">
            <tr class="font-inter">
                <th scope="col" class="text-sm font-medium
                 px-6  text-left px-6">
                    Name
                </th>
                <th scope="col" class="text-sm font-medium px-6 text-left">
                    Subject
                </th>
                <th scope="col" class="text-sm font-medium px-6 text-left">
                    Text
                </th>
            </tr>
            </thead>
            <tbody class="font-inter">
            <tr class="border-b" v-for="template in templates" >
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ template.name }}</td>
                <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                    {{ template.subject }}
                </td>
                <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                    {{ template.text.substring(0, 20) }}...
                </td>
                <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                    <button @click="router.get(`/template/${template.id}`)" class="px-5 py-2 bg-black text-white rounded text-label-medium">Edit</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup lang="ts">

import {router} from "@inertiajs/vue3";
import {Template} from "../../models/Template";

const props = defineProps<{
    templates: Template[];
}>()

</script>

<style scoped>

</style>
