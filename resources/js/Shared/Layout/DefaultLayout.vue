<template>
    <div class="h-screen">
        <NavBar/>
        <div class="p-5">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import NavBar from "../Nav/NavBar.vue";

export default {
    name: "DefaultLayout",
    components: {NavBar}
}
</script>

<style scoped>

</style>
