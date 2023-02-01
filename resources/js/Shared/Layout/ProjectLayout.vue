<template>
    <div class="h-screen">
        <nav class="flex justify-center w-full">
            <section class="w-4/5 py-3">
                <LogoBar/>
                <ProjectNavBar/>
            </section>
        </nav>

        <div class="w-full flex justify-center">
            <div class="w-4/5">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import LogoBar from "../Nav/LogoBar.vue";
import ProjectNavBar from "../Nav/ProjectNavBar.vue";


</script>

<style scoped>

</style>
