<script setup lang="ts">

import {cn} from "../../composables/css";
import {MenuButton, MenuItem, MenuItems, Menu} from "@headlessui/vue";


</script>

<template>
    <Menu as="div" class="relative inline-block text-left">
        <MenuButton class="flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none focus:bg-accent data-[state=open]:bg-accent">More</MenuButton>
        <MenuItems :class="cn('z-50 overflow-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md absolute right-0 w-max min-w-[10rem]')">
            <slot/>
        </MenuItems>
    </Menu>
</template>


<style scoped>

</style>
