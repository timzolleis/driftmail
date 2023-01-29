    <template>
        <div class="font-inter text-center">
            <h2 class="text-title-medium font-semibold">You do not have any templates</h2>
            <p class="text-label-medium text-gray-600">If you want to create a new template, you can do so here:</p>
            <Link href="/template/new" class="px-3 py-2 mt-3 inline-block rounded bg-black font-inter text-label-large text-white">New Template</Link>
        </div>
    </template>




    <script>
    import {Link} from '@inertiajs/vue3'

    export default {
        name: "NoTemplatesComponent",
        components: {Link}
    }
    </script>

<style scoped>

</style>
