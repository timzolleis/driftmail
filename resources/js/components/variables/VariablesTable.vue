<template>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="border-b">
            <tr class="font-inter">
                <th scope="col" class="text-sm font-medium
                 px-6  text-left px-6">
                    Key
                </th>
                <th scope="col" class="text-sm font-medium px-6 text-left">
                    Value
                </th>
                <th scope="col" class="text-sm font-medium px-6 text-left">
                    Description
                </th>
                <th scope="col" class="text-sm font-medium px-6 text-left">
                    Type
                </th>
            </tr>
            </thead>
            <tbody class="font-inter">
            <tr class="border-b" v-for="variable in variables" >
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ variable.key }}</td>
                <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                    {{ variable.value }}
                </td>
                <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                    {{ variable.description }}
                </td>
                <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                   <div class="flex">
                      <div v-if="variable.is_global === '1'" class="text-fuchsia-500 flex items-center justify-center space-x-2 rounded-full border border-fuchsia-300 bg-white py-2 px-5 shadow-lg transition-all hover:border-fuchsia-800">
                          Global
                      </div>
                       <div v-else class="text-violet-500 flex items-center justify-center space-x-2 rounded-full border border-violet-300 bg-white py-2 px-5 shadow-lg transition-all hover:border-violet-800">
                           Local
                       </div>
                   </div>
                </td>
                <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                   <BlackButton button-text="Edit" @click="router.get(`/variable/${variable.id}`)"></BlackButton>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup lang="ts">

import {router} from "@inertiajs/vue3";
import {Variable} from "../../models/Variable";
import BlackButton from "../common/BlackButton.vue";

const props = defineProps<{
    variables: Variable[];
}>()

</script>

<style scoped>

</style>
