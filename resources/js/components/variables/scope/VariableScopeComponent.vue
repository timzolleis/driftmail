<template>
    <span class="flex items-center gap-2">
        <span>
            <GlobeIcon
                class="stroke-violet-400 h-4"
                v-if="scope.id.includes('global')"
            ></GlobeIcon>
            <UserIcon
                class="stroke-fuchsia-400 h-4"
                v-if="scope.id.includes('user')"
            >
            </UserIcon>
        </span>
        <span :class="['font-normal', 'block truncate']">
            {{ scope.name }}</span
        >
    </span>
</template>

<script setup lang="ts">
import GlobeIcon from "../../../Shared/icons/GlobeIcon.vue";
import UserIcon from "../../../Shared/icons/UserIcon.vue";
import { SelectOption } from "../../../models/Select";

const props = defineProps<{
    scope: SelectOption;
}>();
</script>

<style scoped></style>
