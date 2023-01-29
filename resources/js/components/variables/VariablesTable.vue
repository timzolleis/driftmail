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
                      <div v-if="variable.is_global === '1'" class="rounded-full bg-red-500/20 font-inter text-red-500 text-center py-1 px-3">
                          Global
                      </div>
                       <div v-else class="rounded-full bg-green-500/20 font-inter text-green-500 text-center py-1 px-3">
                           Local
                       </div>
                   </div>
                </td>
                <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                    <button @click="router.get(`/variable/${variable.id}`)" class="px-5 py-2 bg-black text-white rounded text-label-medium">Edit</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup lang="ts">

import {router} from "@inertiajs/vue3";
import {Variable} from "../../models/Variable";

const props = defineProps<{
    variables: Variable[];
}>()

</script>

<style scoped>

</style>
