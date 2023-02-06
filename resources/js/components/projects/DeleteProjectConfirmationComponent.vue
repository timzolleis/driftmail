<template>
    <div class="px-10 py-5">
        <p class="font-inter text-label-medium text-gray-600">
            Please confirm the deletion of your project <span class="font-bold">{{ project.name }}</span>
        </p>
        <TextInput :use-label="true"
                   :label="`Type ${confirmationParameters} to confirm the deletion of your project`"
                   v-model="confirmationInput"></TextInput>
        <div class="flex items-center gap-2 w-full justify-between mt-10">
            <BlackButton
                class="w-full"
                button-text="No, cancel"
                @click="emit('cancel')"
            ></BlackButton>
            <BlackButton
                :disabled="isDisabled"
                class="border-red-400 bg-red-500 w-full hover:border-red-500 disabled:bg-red-300 disabled:border-red-300"
                button-text="Yes, delete"
                @click="emit('confirm')"
            ></BlackButton>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Project} from "../../models/Project";
import BlackButton from "../common/BlackButton.vue";
import {usePage} from "@inertiajs/vue3";
import {User} from "../../models/User";
import TextInput from "../form/TextInput.vue";
import {ref} from "@vue/reactivity";
import {watch} from "@vue/runtime-core";


const props = defineProps<{
    project: Project
}>()

function constructConfirmationParameters() {
    const user = <User | undefined>usePage().props?.user
    return `${user?.display}/${props.project.name}`
}

const confirmationParameters = constructConfirmationParameters()

const confirmationInput = ref('')
const isDisabled = ref(true)

watch(confirmationInput, (newValue) => {
    isDisabled.value = newValue !== confirmationParameters;
})


const emit = defineEmits(['confirm', 'cancel'])

</script>

<style scoped>

</style>
