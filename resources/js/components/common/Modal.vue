<template>
    <Transition name="modal">
        <div
            @click="emit('close')"
            v-if="show"
            class="backdrop-blur bg-black bg-opacity-10 p-3 fixed md:px-10 left-0 top-0 right-0 bottom-0 flex flex-col items-center justify-center transition-opacity duration-300 ease-in-out"
        >
            <div
                class="fixed z-50 grid w-full gap-4 rounded-b-lg border bg-background p-6 shadow-lg animate-in data-[state=open]:fade-in-90 data-[state=open]:slide-in-from-bottom-10 sm:rounded-lg sm:zoom-in-90 data-[state=open]:sm:slide-in-from-bottom-0 sm:max-w-[425px]"
                @click.stop=""
            >
                <div class="flex flex-col text-primary">
                    <p class="text-lg font-semibold leading-none tracking-tight">
                        {{ title }}
                    </p>

                    <div class="py-5">
                        <slot></slot>
                    </div>
                    <div class="flex items-center gap-2 justify-end">
                        <slot name="secondary-action"></slot>
                        <slot name="primary-action"></slot>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup lang="ts">

const props = defineProps<{
    title: string;
    show: boolean;
}>();

const emit = defineEmits(["close"]);
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
