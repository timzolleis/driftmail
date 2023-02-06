<template>
    <div class="flex py-3 justify-between border-b">
        <PageHeader title="Project settings" />
    </div>
    <ProjectSettingsComponent :project="project" :settings="settings" />
</template>
<script setup lang="ts">

import PageHeader from "../../Shared/Page/PageHeader.vue";
import BlackButton from "../../components/common/BlackButton.vue";
import ProjectLayout from "../../Shared/Layout/ProjectLayout.vue";
import ProjectSettingsComponent from "../../components/project-settings/ProjectSettingsComponent.vue";
import {Project, ProjectSettings} from "../../models/Project";
defineOptions({layout: ProjectLayout})

const props = defineProps<{
    project: Project
    settings: ProjectSettings
}>()
</script>

<style scoped>

</style>
