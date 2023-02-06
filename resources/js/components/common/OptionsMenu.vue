<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton>
                <HorizontalEllipsisIcon></HorizontalEllipsisIcon>
            </MenuButton>
        </div>

        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <MenuItems
                class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
                <div class="px-1 py-1">
                    <MenuItem v-for="option in options" v-slot="{ active }">
                        <button
                            @click="emit(option.emit)"
                            :class="[
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm hover:bg-gray-100',
                                option.color,
                            ]"
                        >
                            {{ option.name }}
                        </button>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>
<script lang="ts">
import { DropdownOption } from "../../models/Select";

export default {
    props: {
        options: Object,
    },
};
</script>
<script setup lang="ts">
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { DropdownOption } from "../../models/Select";
import HorizontalEllipsisIcon from "../../Shared/icons/HorizontalEllipsisIcon.vue";

const props = defineProps<{
    options: DropdownOption[];
}>();

function getArray() {
    return props.options.map((option) => {
        return option.emit;
    });
}

const emit = defineEmits();
</script>
