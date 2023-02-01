<template>
    <Transition name="modal">
        <div
            @click="emit('close')"
            v-if="show"
            class="backdrop-blur bg-black bg-opacity-10 p-3 fixed px-10 left-0 top-0 right-0 bottom-0 flex flex-col items-center justify-center transition-opacity duration-300 ease-in-out">
            <div class="modal-container rounded-xl bg-white w-full md:w-3/4 lg:w-1/2 z-100 transition-all duration-300 ease-in-out" @click.stop="">
                <div class="flex flex-col py-5">
                    <div
                        class="flex flex-col gap-2  items-center font-bold font-inter text-headline-small border-b border-gray-600/20 pb-2">
                        <img class="h-10" src="/assets/img/mail-icon.svg" alt="">
                        <p class="font-inter text-title-small font-semibold">{{ title }}</p>
                    </div>
                    <div class="bg-gray-50">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </Transition>

</template>

<script setup lang="ts">

const props = defineProps<{
    title: string;
    show: boolean
}>()

const emit = defineEmits(['close'])

</script>

<style scoped>

.modal-enter-from {
    opacity: 0;
}

.modal-leave-to {
    opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>
