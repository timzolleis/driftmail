<template>
    <div class="flex items-center justify-between gap-2 pb-3">
        <h3 class="font-inter text-title-small font-medium text-gray-600">Variables</h3>
        <button class="px-3 py-1.5 rounded ring ring-1 ring-gray-600 text-white bg-black  font-inter" type="button" @click="router.get('/variable/new')">
            <span class="flex items-center gap-2">
                <img src="/assets/img/add-icon.svg" class="h-6" alt="">
                Create
            </span>
        </button>
    </div>
    <CardContainer>
        <div v-if="variables.length > 0">
            <VariablesTable :variables="variables"/>
        </div>
        <div v-else>
            <NoVariablesComponent/>
        </div>

    </CardContainer>


</template>

<script lang="ts">
import CardContainer from "../../Shared/Layout/CardContainer.vue";

export default {
    name: "VariablesComponent",
    components: {CardContainer}
}
</script>

<script setup lang="ts">
import {router} from "@inertiajs/vue3";
import {Variable} from "../../models/Variable";
import VariablesTable from "./VariablesTable.vue";
import NoVariablesComponent from "./NoVariablesComponent.vue";

const props = defineProps<{ variables?: Variable[] }>()
</script>

<style scoped>

</style>
