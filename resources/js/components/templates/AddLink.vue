<script setup lang="ts">

import Label from "../Label.vue";
import TextInput from "../form/TextInput.vue";
import StyledButton from "../StyledButton.vue";
import {computed, ref} from "@vue/reactivity";

const url = ref("")
const display = ref("");
const emit = defineEmits<{
    (e: "insert", value: string): void
}>()
const link = computed(() => {
    return `[${display.value}](${url.value})`
})
const errors = ref({
    url: "",
})
const insertLink = () => {
    if (url.value.length <= 6) {
        errors.value.url = "Please insert a valid url"
        return;
    }
    if (display.value.length === 0) {
        display.value = url.value
    }
    emit('insert', link.value)
}

const reset = () => {
    errors.value.url = ""
}


</script>
<template>
    <div>
        <Label>URL</Label>
        <TextInput @input="reset" :error-message="errors.url" v-model="url"></TextInput>
        <Label>Text to display</Label>
        <TextInput v-model="display"></TextInput>
        <div class="flex justify-end">
            <StyledButton @click="insertLink">Insert</StyledButton>
        </div>
    </div>
</template>

<style scoped>

</style>
