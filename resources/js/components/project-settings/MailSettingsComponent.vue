<template>
    <div class="grid grid-cols-2 gap-2">
        <TextInput
            :error-message="form.errors.mailHost"
            placeholder="smtp.example.com"
            v-model="form.mailHost"
            :use-label="true"
            label="Mail host"
        ></TextInput>
        <TextInput
            :error-message="form.errors.mailPort"
            placeholder="587"
            v-model="form.mailPort"
            :use-label="true"
            label="Mail post"
        ></TextInput>
        <TextInput
            :error-message="form.errors.mailUser"
            placeholder="username"
            v-model="form.mailUser"
            :use-label="true"
            label="Mail user"
        ></TextInput>
        <PasswordInput
            :error-message="form.errors.mailPassword"
            v-model="form.mailPassword"
            :use-label="true"
            label="Mail password"
        ></PasswordInput>
        <TextInput
            :error-message="form.errors.mailSendingAddress"
            placeholder="fancy@service.com"
            v-model="form.mailSendingAddress"
            :use-label="true"
            label="Mail sending address"
        ></TextInput>
        <TextInput
            :error-message="form.errors.mailSendingName"
            placeholder="My fancy service"
            v-model="form.mailSendingName"
            :use-label="true"
            label="Mail sending name"
        ></TextInput>
    </div>
</template>

<script setup lang="ts">

import TextInput from "../form/TextInput.vue";
import PasswordInput from "../form/PasswordInput.vue";
import {ProjectSettings} from "../../models/Project";
import {SettingsForm} from "../../composables/settings";
import {watch} from "@vue/runtime-core";

const props = defineProps<{
    modelValue: SettingsForm
}>()
const emit = defineEmits(['update:modelValue'])
const form = props.modelValue
watch(form, (newValue) => {
    emit('update:modelValue', form)
})


</script>

<style scoped>

</style>
