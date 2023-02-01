<template>
    <div class="flex py-3 justify-between border-b">
        <PageHeader :title="project.name"/>
    </div>
</template>

<script setup lang="ts">
import PageHeader from "../../Shared/Page/PageHeader.vue";
import {router} from "@inertiajs/vue3";
import BlackButton from "../../components/common/BlackButton.vue";
import {Project} from "../../models/Project";
import {defineOptions} from "unplugin-vue-define-options/macros";
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";

defineOptions({layout: ProjectLayout})

const props = defineProps<{
    project: Project
}>()

</script>


<style scoped>

</style>
