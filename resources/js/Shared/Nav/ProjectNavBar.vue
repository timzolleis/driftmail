<template>
    <nav
        class="w-full space-x-3 flex items-center gap-1 font-inter text-label-medium font-medium border-b py-1 transition ease-in-out"
    >
        <div class="py-1 hover:bg-gray-400/20 rounded px-2">
            <button class="py-1" @click="navigateTo('')">Project</button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded px-2">
            <button class="py-1" @click="navigateTo('variables')">
                Variables
            </button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded px-2">
            <button class="py-1" @click="navigateTo('templates')">
                Templates
            </button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded px-2">
            <button class="py-1" @click="navigateTo('settings')">
                Settings
            </button>
        </div>
    </nav>
</template>

<script setup lang="ts">
import { useRelativeNavigation } from "../../composables/navigation";

function navigateTo(path: string) {
    return useRelativeNavigation("/project", path);
}
</script>

<style scoped></style>
