<script lang="ts" setup>
import {LogOut} from "lucide-vue-next";
import {Link} from "@inertiajs/vue3";
import {usePage} from "@inertiajs/vue3";
</script>

<template>
    <div class="flex">
        <nav>
            <aside
                class="hidden h-screen w-[250px] flex-shrink-0 flex-col justify-between border-r border-slate-6 md:flex">
                <div>
                    <div class="flex h-[60px] items-center px-4">
                        <Link href="/" class="font-medium">driftmail</Link>
                    </div>
                    <div class="mt-6 px-4 space-y-3">
                       <slot name="links"></slot>
                    </div>
                </div>
                <div class="p-4 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <img class="rounded-full h-8" :src="usePage().props.user?.avatar_url" alt="">
                        <p class="font-medium">{{ usePage().props.user.display }}</p>
                    </div>
                    <Link href="/logout">
                        <LogOut class="text-gray-600 h-5 w-5 hover:text-primary hover:scale-110"></LogOut>
                    </Link>
                </div>
            </aside>
        </nav>
        <div class="w-full">
            <div class="flex h-[60px] items-center justify-end border-b border-slate-6 px-6">
                <Link class="text-sm font-medium text-stone-800" target="_blank"
                      href="https://github.com/timzolleis/driftmail">GithHub
                </Link>
            </div>
            <div class="h-[calc(100vh-60px)] overflow-auto pb-10 mx-auto max-w-5xl px-6">
                <slot name="main"></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
