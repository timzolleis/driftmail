<template>
    <div
        class="space-y-1 peer block rounded-md border divide-y divide-gray-200 border-gray-200 bg-white p-2 text-sm shadow-lg focus:border-black focus:outline-none focus:ring-0"
    >
        <div
            v-for="variable in variables"
            @click="emit('insert', variable.key)"
        >
            <p
                class="font-inter text-label-small py-1 px-3 rounded-md block hover:bg-black hover:text-white"
            >
                {{ variable.key }}
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Variable } from "../../../models/Variable";

const props = defineProps<{
    variables: Variable[];
}>();

const emit = defineEmits(["insert"]);
</script>

<style scoped></style>
