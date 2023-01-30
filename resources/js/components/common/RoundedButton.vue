<template>
    <button class="rounded-full inline-block border border-black bg-black py-1.5 px-5 text-sm text-white transition-all hover:bg-white hover:text-black" >{{buttonText}}</button>
</template>

<script>
export default {
    name: "RoundedButton",
    props: {
        buttonText: String
    }
}
</script>

<style scoped>

</style>
