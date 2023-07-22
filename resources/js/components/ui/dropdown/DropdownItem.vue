<script setup lang="ts">

import {MenuItem} from "@headlessui/vue";
</script>

<template>
    <MenuItem class="relative] flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 hover:bg-accent" v-slot="{ active }">
      <slot/>
    </MenuItem>
</template>

<style scoped>

</style>
