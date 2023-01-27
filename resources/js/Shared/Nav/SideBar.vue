<template>
    <div class="h-full w-44 bg-black p-3 overflow-y-auto">
        <Link class="p-3 rounded bg-white font-inter" href="/projects">Projekte</Link>
    </div>


</template>

<script>
import {Link} from '@inertiajs/vue3'

export default {
    name: "SideBar",
    components: {Link}
}
</script>

<style scoped>

</style>
