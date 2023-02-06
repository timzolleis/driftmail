<template>
    <Modal :show="showModal" @close="emit('close')" title="Confirm deletion">
        <div class="px-10 py-5">
            <p class="font-inter text-label-medium text-gray-600">
                {{ confirmationText }}
            </p>
            <div class="flex items-center gap-2 w-full justify-between mt-10">
                <BlackButton
                    class="w-full"
                    @click="emit('cancel')"
                    button-text="No, cancel"
                ></BlackButton>
                <BlackButton
                    @click="emit('confirm')"
                    class="border-red-400 bg-red-500 w-full hover:border-red-500"
                    button-text="Yes, delete"
                ></BlackButton>
            </div>
        </div>
    </Modal>
</template>

<script setup lang="ts">
import Modal from "./Modal.vue";
import BlackButton from "./BlackButton.vue";

const emit = defineEmits(["close", "confirm", "cancel"]);
const props = defineProps<{
    showModal: boolean;
    confirmationText: string;
}>();
</script>

<style scoped></style>
