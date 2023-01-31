<template>
    <div class="flex py-3 justify-between border-b">
        <PageHeader title="My Projects"/>
        <BlackButton button-text="Add"
                     class="rounded ring ring-1 ring-gray-600 text-white bg-black font-inter" type="button"
                     @click="router.get('/project/new')">
        </BlackButton>
    </div>
    <main class="py-4">
        <section>
            <ProjectsComponent :projects=projects></ProjectsComponent>
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
import {computed} from "@vue/reactivity";
import {router, usePage} from "@inertiajs/vue3";
import BlackButton from "../components/common/BlackButton.vue";

const props = defineProps<{
    projects?: Project[],
    variables?: Variable[],
    templates?: Template[]
}>()
</script>

<style scoped>

</style>
