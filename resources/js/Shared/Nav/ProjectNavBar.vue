<template>
    <nav
        class="w-full space-x-3 flex items-center gap-2 font-inter text-label-medium font-medium border-b py-1 transition ease-in-out"
    >
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" @click="navigateTo('')">Project</button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button
                class="py-1"
                @click="navigateTo('variables')"
                :class="
                    isActive('variable')
                        ? 'border-b-2 border-black'
                        : 'border-0'
                "
            >
                Variables
            </button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" @click="navigateTo('templates')">
                Templates
            </button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" @click="navigateTo('settings')">
                Settings
            </button>
        </div>
    </nav>
</template>

<script setup lang="ts">
import { router } from "@inertiajs/vue3";
import { useRelativeNavigation } from "../../composables/navigation";
import { ref } from "@vue/reactivity";
import { lilconfig } from "lilconfig";
import { onMounted, onUnmounted, onUpdated } from "@vue/runtime-core";

const currentUrl = ref("");
onUpdated(() => (currentUrl.value = window.location.pathname));

const isActive = (link: string) => currentUrl.value.includes(link);
function navigateTo(path: string) {
    return useRelativeNavigation("/project", path);
}
</script>

<style scoped></style>
