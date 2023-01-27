<template>
    <DefaultLayout>
        <slot></slot>
    </DefaultLayout>
</template>

<script>
import NavBar from "../Nav/NavBar.vue";
import DefaultLayout from "./DefaultLayout.vue";
import SideBar from "../Nav/SideBar.vue";

export default {
    name: "AuthenticatedLayout",
    components: {SideBar, DefaultLayout, NavBar}
}
</script>

<style scoped>

</style>
