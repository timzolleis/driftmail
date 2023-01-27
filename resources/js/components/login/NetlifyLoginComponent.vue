<template>
        <form @submit.prevent="post" class="flex w-1/2 rounded-xl p-20 ring ring-1 ring-gray-800" method="POST">
            <button type="submit" class="flex w-full justify-center gap-2 p-3 shadow rounded-lg shadow-lg ring ring-2 ring-gray-800/10">
                    <img src="/assets/img/netlify-logo.svg" class="h-6" alt="">
                    <span class="font-inter font-semibold ">Login with Netlify</span>
            </button>
        </form>
</template>

<script>

import {router} from "@inertiajs/vue3"

export default {

    name: "NetlifyLoginComponent",
    setup() {
        function post(){
            router.post('/login')
        }

        return{
            post
        }

    }
}
</script>

<style scoped>

</style>
