<template>
    <div class="w-full flex justify-between font-inter">
        <div class="flex gap-2 items-center">
            <img class="h-8" src="/assets/img/mail-icon.svg" alt="">
        </div>
        <div>
            <div v-if="!user">
                <button @click="router.get('/login')"
                        class="rounded-full border border-black bg-black py-1.5 px-5 text-sm text-white transition-all hover:bg-white hover:text-black">
                    Login
                </button>
            </div>
            <div v-if="user">
                <div class="flex gap-2">
                    <img class="h-10 rounded-full" :src="user.avatar_url" alt="">
                    <button @click="router.get('/logout')"
                            class="rounded-full border border-black bg-black py-1.5 px-5 text-sm text-white transition-all hover:bg-white hover:text-black">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">

import {router, usePage} from "@inertiajs/vue3";

const user = usePage().props?.user


</script>

<style scoped>

</style>
