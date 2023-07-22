<template>
    <AppLayout>
        <template v-slot:links>
            <Link :href="`/project/${project?.id}`" class="flex items-center gap-2 p-2 rounded-md"
                  :class="usePage().url === (`/project/${project?.id}`) && 'bg-gray-100'">
                <Folder class="w-5 h-5 text-stone-800"></Folder>
                <span class="text-sm font-medium text-stone-800">Project</span>
            </Link>
            <Link :href="`/project/${project?.id}/variables`" class="flex items-center gap-2 p-2 rounded-md"
                  :class="usePage().url.includes('variables') && 'bg-gray-100'">
                <FileEdit class="w-5 h-5 text-stone-800"></FileEdit>
                <span class="text-sm font-medium text-stone-800">Variables</span>
            </Link>
            <Link :href="`/project/${project?.id}/templates`" class="flex items-center gap-2 p-2 rounded-md"
                  :class="usePage().url.includes('template') && 'bg-gray-100'">
                <LayoutPanelTop class="w-5 h-5 text-stone-800"></LayoutPanelTop>
                <span class="text-sm font-medium text-stone-800">Templates</span>
            </Link>
            <Link :href="`/project/${project?.id}/settings`" class="flex items-center gap-2 p-2 rounded-md"
                  :class="usePage().url.includes('settings') && 'bg-gray-100'">
                <Settings class="w-5 h-5 text-stone-800"></Settings>
                <span class="text-sm font-medium text-stone-800">Settings</span>
            </Link>
        </template>
        <template v-slot:main>
            <slot/>
        </template>
    </AppLayout>
</template>

<script setup lang="ts">
import LogoBar from "../Nav/LogoBar.vue";
import ProjectNavBar from "../Nav/ProjectNavBar.vue";
import {Link} from "@inertiajs/vue3";
import {Folder, FileEdit, Settings, LayoutPanelTop} from "lucide-vue-next";
import {usePage} from "@inertiajs/vue3";
import AppLayout from "./AppLayout.vue";
import {Project} from "../../models/Project";


const project = usePage().props?.project as Project | undefined

</script>

<style scoped></style>
