<template>
    <nav class="w-full space-x-3 flex items-center gap-2 font-inter text-label-medium font-medium border-b py-1 transition ease-in-out">
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" :class="isActive('/') ? 'border-b-2 border-black': ''">Dashboard</button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" :class="isActive('/project') ? 'border-b-2 border-black': ''">Projects</button>
        </div>
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" :class="isActive('/variable') ? 'border-b-2 border-black': ''">Variables</button>
        </div>
        <div class="py-2 hover:bg-gray-400/20 rounded">
            <button class="py-1" :class="isActive('/templates') ? 'border-b-2 border-black': ''">Templates</button>
        </div>

    </nav>


</template>

<script setup lang="ts">

function isActive(link: string){
    return window.location.pathname.includes(link);
}


</script>

<style scoped>

</style>
