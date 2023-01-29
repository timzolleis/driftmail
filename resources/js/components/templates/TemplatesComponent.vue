<template>
    <div class="flex items-center justify-between gap-2 pb-3">
        <h3 class="font-inter text-title-small font-medium text-gray-600">Templates</h3>
        <button class="px-3 py-1.5 rounded ring ring-1 ring-gray-600 text-white bg-black  font-inter" type="button" @click="router.get('/template/new')">
            <span class="flex items-center gap-2">
                <img src="/assets/img/add-icon.svg" class="h-6" alt="">
                Create
            </span>
        </button>
    </div>
    <CardContainer>
        <div v-if="templates.length > 0">
            <TemplatesTable :templates="templates"/>
        </div>
        <div v-else>
            <NoTemplatesComponent/>
        </div>

    </CardContainer>


</template>

<script lang="ts">
import CardContainer from "../../Shared/Layout/CardContainer.vue";

export default {
    name: "TemplatesComponent",
    components: {CardContainer}
}
</script>

<script setup lang="ts">
import {router} from "@inertiajs/vue3";
import TemplatesTable from "./TemplatesTable.vue";
import {Template} from "../../models/Template";
import NoTemplatesComponent from "./NoTemplatesComponent.vue";

const props = defineProps<{ templates?: Template[] }>()
</script>

<style scoped>

</style>
