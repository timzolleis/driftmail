<template>
    <div class="w-full flex justify-center py-20 items-center">
        <NetlifyLoginComponent/>
    </div>

</template>

<script>
import DefaultLayout from "../Shared/Layout/DefaultLayout.vue";
import NetlifyLoginComponent from "../components/login/NetlifyLoginComponent.vue";

export default {
    name: "Login",
    components: {NetlifyLoginComponent},
    layout: DefaultLayout
}
</script>

<style scoped>

</style>
