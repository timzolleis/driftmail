<template>
    <nav class="w-full space-x-3 flex items-center gap-2 font-inter text-label-medium font-medium border-b py-1 transition ease-in-out">
        <div class="py-1 hover:bg-gray-400/20 rounded">
            <button class="py-1" :class="isActive('/') ? 'border-b-2 border-black': ''">Projects</button>
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
