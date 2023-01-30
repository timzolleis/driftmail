<template>
    <div class="flex items-center justify-between gap-2 pb-3">
        <h3 class="font-inter text-title-small font-medium text-gray-600">Templates</h3>
        <BlackButton button-text="Add" v-if="templates.length > 0" class="px-3 py-1.5 rounded ring ring-1 ring-gray-600 text-white bg-black  font-inter" type="button" @click="router.get('/template/new')">

        </BlackButton>
    </div>
    <CardContainer>
        <div v-if="templates.length > 0">
            <TemplatesTable :templates="templates"/>
        </div>
        <div v-else>
           <NotPresentComponent type="Template" link="/template/new" />
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
import NotPresentComponent from "../common/NotPresentComponent.vue";
import BlackButton from "../common/BlackButton.vue";

const props = defineProps<{ templates?: Template[] }>()
</script>

<style scoped>

</style>
