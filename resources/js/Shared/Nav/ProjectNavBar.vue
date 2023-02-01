<template>
    <nav
        class="w-full space-x-3 flex items-center gap-2 font-inter text-label-medium font-medium border-b py-1 transition ease-in-out">
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" @click="navigateTo('')"
                    :class="isActive('/template') ? 'border-b-2 border-black': 'border-0'">Project
            </button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" @click="navigateTo('variables')"
                    :class="isActive('/template') ? 'border-b-2 border-black': 'border-0'">Variables
            </button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" @click="navigateTo('templates')"
                    :class="isActive('templates') ? 'border-b-2 border-black': 'border-0'">Templates
            </button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" @click="navigateTo('settings')"
                    :class="isActive('templates') ? 'border-b-2 border-black': 'border-0'">Settings
            </button>
        </div>
    </nav>

</template>

<script setup lang="ts">

import {router} from "@inertiajs/vue3";
import {useRelativeNavigation} from "../../composables/navigation";

function isActive(link: string) {
    return window.location.pathname.includes(link);
}


function navigateTo(path: string) {
    return useRelativeNavigation('/project', path)
}


</script>

<style scoped>

</style>
