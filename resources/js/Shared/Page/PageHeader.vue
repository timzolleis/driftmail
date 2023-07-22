<template>
   <div class="flex items-center justify-between mx-auto max-w-5xl py-8">
       <h2 class="text-[28px] leading-[34px] tracking-[-0.416px] text-slate-12 font-bold"><slot name="title"></slot></h2>
       <slot name="cta"/>
   </div>
</template>

<script>
export default {
    name: "PageHeader",
    props: {
        title: String
    }
}
</script>

<style scoped>

</style>
