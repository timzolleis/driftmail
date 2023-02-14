<template>
    <div class="w-full flex justify-center py-20 items-center">
        <div
            class="flex flex-col gap-2 w-full md:w-2/3 xl:w-1/3 rounded-xl p-20 ring ring-1 ring-gray-800/10 shadow shadow-lg"
        >
            <button
                @click="router.get('/oauth/login?provider=netlify')"
                type="submit"
                class="flex w-full justify-center gap-2 p-3 shadow rounded-lg shadow-lg ring ring-1 ring-gray-800/10"
            >
                <img src="/assets/img/netlify-logo.svg" class="h-6" alt="" />
                <span class="font-inter font-semibold">Login with Netlify</span>
            </button>
            <button
                @click="router.get('/oauth/login?provider=github')"
                type="submit"
                class="flex w-full justify-center gap-2 p-3 shadow rounded-lg shadow-lg ring ring-1 bg-black ring-gray-800/10"
            >
                <img src="/assets/img/github-logo.svg" class="h-6" alt="" />
                <span class="font-inter font-semibold text-white"
                    >Login with Github</span
                >
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import DefaultLayout from "../Shared/Layout/DefaultLayout.vue";
import NetlifyLoginComponent from "../components/login/NetlifyLoginComponent.vue";
import { router } from "@inertiajs/vue3";
</script>

<style scoped></style>
