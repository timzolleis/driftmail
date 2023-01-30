<template>
    <DefaultLayout>
        <slot></slot>
    </DefaultLayout>
</template>

<script>
import DefaultLayout from "./DefaultLayout.vue";

export default {
    name: "AuthenticatedLayout",
    components: {DefaultLayout}
}
</script>

<style scoped>

</style>
