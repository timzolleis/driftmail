<template>
    <AppLayout>
        <template v-slot:links>
            <Link href="/" class="flex items-center gap-2 p-2 rounded-md"
                  :class="usePage().url === '/' && 'bg-gray-100'">
                <Folder class="w-5 h-5 text-stone-800"></Folder>
                <span class="text-sm font-medium text-stone-800">Projects</span>
            </Link>
        </template>
        <template v-slot:main>
            <slot/>
        </template>
    </AppLayout>
</template>

<script>
import LogoBar from "../Nav/LogoBar.vue";
import NavBar from "../Nav/NavBar.vue";
import {Link, usePage} from "@inertiajs/vue3";
import {Folder, LogOut} from "lucide-vue-next";
import AppLayout from "@/Shared/Layout/AppLayout.vue";

export default {
    name: "DefaultLayout",
    methods: {
        usePage,
    },
    components: {AppLayout, NavBar, LogoBar, Link, Folder, LogOut},
};
</script>

<style scoped></style>
