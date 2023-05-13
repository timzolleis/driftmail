<template>
    <Head>
        <title>driftmail</title>
        <link rel="icon" type="image/svg+xml" href="/assets/img/mail-icon-white.svg"/>
    </Head>
    <div class="h-screen">
        <nav class="flex justify-center w-full">
            <section class="w-11/12 lg:w-4/5 py-3">
                <LogoBar/>
                <NavBar/>
            </section>
        </nav>

        <div class="w-full flex justify-center">
            <div class="w-4/5">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
import LogoBar from "../Nav/LogoBar.vue";
import {Head} from "@inertiajs/vue3"
import NavBar from "../Nav/NavBar.vue";

export default {
    name: "DefaultLayout",
    components: {NavBar, LogoBar, Head},
};
</script>

<style scoped></style>
