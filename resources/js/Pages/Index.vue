<template>
    <PageHeader title="Dashboard"/>
    <main class="space-y-4">
        <section>
            <ProjectsComponent :projects=projects></ProjectsComponent>
        </section>
        <section>
            <VariablesComponent :variables="variables"></VariablesComponent>
        </section>
        <section>
            <TemplatesComponent :templates="templates"></TemplatesComponent>
        </section>
    </main>
</template>

<script lang="ts">
import AuthenticatedLayout from "../Shared/Layout/AuthenticatedLayout.vue";
import ProjectsComponent from "../components/projects/ProjectsComponent.vue";

export default {
    name: "Index",
    components: {ProjectsComponent},
    layout: AuthenticatedLayout,
}
</script>

<script setup lang="ts">
import {Project} from "../models/Project";
import PageHeader from "../Shared/Page/PageHeader.vue";
import VariablesComponent from "../components/variables/VariablesComponent.vue";
import {Variable} from "../models/Variable";
import TemplatesComponent from "../components/templates/TemplatesComponent.vue";
import {Template} from "../models/Template";

const props = defineProps<{
    projects?: Project[],
    variables?: Variable[],
    templates?: Template[]
}>()
</script>

<style scoped>

</style>
