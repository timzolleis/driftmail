<template>
    <button class="rounded-md inline-block border border-black bg-black py-1.5 px-8 text-sm text-white transition-all hover:bg-white hover:text-black" >{{buttonText}}</button>
</template>

<script>
export default {
    name: "BlackButton",
    props: {
        buttonText: String
    }
}
</script>

<style scoped>

</style>
