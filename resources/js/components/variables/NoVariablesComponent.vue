<template>
    <div class="font-inter text-center">
        <h2 class="text-title-medium font-semibold">You do not have any variables</h2>
        <p class="text-label-medium text-gray-600">If you want to create a new Variable, you can do so here:</p>
        <Link href="/variable/new" class="px-3 py-2 mt-3 inline-block rounded bg-black font-inter text-label-large text-white">New Variable</Link>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3'

export default {
    name: "NoVariablesComponent",
    components: {Link}
}
</script>

<style scoped>

</style>
