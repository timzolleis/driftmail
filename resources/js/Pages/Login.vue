<template>
    <div class="flex h-screen items-center justify-center">
        <div
            class="mx-auto w-full max-w-[450px] text-center space-y-5"
        >
            <div>
                <h1 class="text-xl font-semibold">Welcome back</h1>
                <p class="text-muted-foreground text-sm">Select a provider below to get started.</p>
            </div>
            <div class="space-y-2">
                <Link
                    href="/oauth/login?provider=netlify"
                    type="submit"
                    class="flex bg-secondary border rounded-md w-full p-3 justify-center items-center gap-2 hover:bg-secondary/80"
                >
                    <img src="/assets/img/netlify-logo.svg" class="h-5" alt=""/>
                    <span class="font-medium text-sm">Netlify</span>
                </Link>
                <Link
                    href="/oauth/login?provider=github"
                    type="submit"
                    class="flex bg-primary hover:bg-primary/80 rounded-md w-full p-3 justify-center items-center gap-2"
                >
                    <img src="/assets/img/github-logo.svg" class="h-5" alt=""/>
                    <span class="text-sm font-medium text-white"
                    >Github</span
                    >
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Link} from '@inertiajs/vue3'

</script>

<style scoped></style>
