<script setup lang="ts">
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import {Settings2} from "lucide-vue-next";
import {LayoutTemplate} from "lucide-vue-next";
import {Link, usePage} from '@inertiajs/vue3'
import {cn} from "../../utils/utils";


function isActive(url: string) {
    return usePage().url?.includes(url)
}

</script>

<template>
    <ProjectLayout>
        <main class="flex flex-col md:flex-row w-full">
            <nav class="w-full md:w-min whitespace-nowrap space-y-5 font-medium text-gray-900 md:mt-10 xl:border-r md:pr-10">
                <Link href="settings"
                      :class="cn('flex items-center gap-2 hover:bg-gray-200 px-5 py-2 rounded-md', isActive('settings') ? 'bg-gray-200' : '')">
                    <Settings2 :size="20"></Settings2>
                    <p>Settings</p>
                </Link>
                <Link href="mail" :class="cn('flex items-center gap-2 hover:bg-gray-200 px-5 py-2 rounded-md', isActive('mail') ? 'bg-gray-200' : '')">
                    <LayoutTemplate :size="20"></LayoutTemplate>
                    <p>Mail template</p>
                </Link>

            </nav>
            <div class="w-full flex flex-col items-center mt-5">
                <div class="max-w-3xl w-full space-y-5">
                    <div class="border-b border-gray-900/10 pb-4">
                        <PageHeader>Edit Template</PageHeader>
                    </div>
                    <slot/>
                </div>
            </div>
        </main>
    </ProjectLayout>


</template>

<style scoped>

</style>
