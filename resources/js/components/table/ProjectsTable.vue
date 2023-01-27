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
                    Description
                </th>
                <th scope="col" class="text-sm font-medium  px-6 py-2 text-left">
                    Active
                </th>

            </tr>
            </thead>
            <tbody class="font-inter">
            <tr class="border-b" v-for="project in projects" >
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ project.name }}</td>
                <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                    {{ project.description }}
                </td>
                <td class="text-sm text-gray-900  px-6 py-4 whitespace-nowrap">
                    {{ project.active }}
                </td>
                <td class="text-sm text-gray-900 px-6 py-4 whitespace-nowrap text-right">
                   <button @click="viewProject(project.id)" class="px-5 py-2 bg-black text-white rounded text-label-medium">Edit</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup lang="ts">

import {Project} from "../../models/Project";
import {router} from "@inertiajs/vue3";


function viewProject(projectId: string){
    router.get(`/project/${projectId}/edit`)
}

const props = defineProps<{
    projects: Project[];
}>()


</script>

<style scoped>

</style>
