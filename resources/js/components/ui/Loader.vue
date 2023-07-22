<script setup  lang="ts">
import {defineComponent} from 'vue'
import {ref} from "@vue/reactivity";

const bars = Array(12).fill(0);
const props = withDefaults(defineProps<{size?: number}>(), {
    size: 20
})

const sizeInPixels = `${props.size}px`;

</script>

<template>
<div :style="{ width: sizeInPixels, height: sizeInPixels }">
    <div class="relative top-1/2 left-1/2" :style="{width: sizeInPixels, height: sizeInPixels}">
        <div v-for="(_, index) in bars" :key="index" class="bg-gray-600 absolute h-[8%] -left-[10%] -top-[3.9]% w-[24%] animate-spinner-loading-bar" :style="{transform: `rotate(${(index + 1) * 30}deg) translate(146%)`, animationDelay: `-${(bars.length - 1) * index * 0.1}s`}">
        </div>
    </div>
</div>


</template>

<style scoped>

</style>
