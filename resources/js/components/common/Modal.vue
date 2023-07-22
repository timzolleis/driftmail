<template>
    <Transition name="modal">
        <div
            @click="emit('close')"
            v-if="show"
            class="bg-black bg-opacity-10 p-3 fixed md:px-10 left-0 top-0 right-0 bottom-0 flex flex-col items-center justify-center transition-opacity duration-300 ease-in-out"
        >
            <div
                class="modal-container rounded-xl bg-white w-full max-w-xl z-100 transition-all duration-300 ease-in-out relative"
                @click.stop=""
            >
               <div class="absolute top-0 right-0 p-2">
                   <X @click="emit('close')" class="text-gray-600 stroke-1 hover:cursor-pointer"></X>
               </div>
                <div class="flex flex-col p-5">
                    <h2 class="font-semibold text-xl"><slot name="title"></slot></h2>
                       <div class="mt-4">
                           <slot/>
                       </div>
                     <div class="flex justify-end items-center gap-2">
                         <Button @click="emit('close')" variant="secondary">Cancel</Button>
                         <slot name="cta"></slot>
                     </div>

                </div>

            </div>
        </div>
    </Transition>
</template>

<script setup lang="ts">
import {X} from "lucide-vue-next";
import Button from "../ui/Button.vue";

const props = defineProps<{
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
