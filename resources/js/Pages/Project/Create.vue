<template>
    <div>
        <PageHeader title="New Project" />
        <p class="font-inter text-gray-800 font-medium text-title-small">General</p>
            <CardContainer>
            </CardContainer>


    </div>
</template>

<script>
import AuthenticatedLayout from "../../Shared/Layout/AuthenticatedLayout.vue";
import PageHeader from "../../Shared/Page/PageHeader.vue";
import CardContainer from "../../Shared/Layout/CardContainer.vue";

export default {
    name: "Create",
    components: {CardContainer, PageHeader},
    layout: AuthenticatedLayout
}
</script>

<style scoped>

</style>
