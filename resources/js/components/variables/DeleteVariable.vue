<script setup lang="ts">

import {scopes} from "../../config/props";
import {useModal} from "../../composables/modal";
import Modal from "../common/Modal.vue";
const {showModal, openModal, closeModal} = useModal()
</script>

<template>
    <Button @click="openModal"><Plus class="h-4 w-4"/>Add variable</Button>
    <Modal :show="showModal" @close="closeModal">
        <template v-slot:title>Add variable</template>
        <fieldset class="grid gap-4">
            <div class="grid gap-2">
                <Label>Key</Label>
                <Input placeholder="eventTitle" v-model="form.key" />
                <Label variant="error">{{form.errors.key}}</Label>
            </div>
            <div class="grid gap-2">
                <Label>Path</Label>
                <Input placeholder="event.title" v-model="form.value" />
                <Label variant="error">{{form.errors.value}}</Label>
            </div>
            <div class="grid gap-2">
                <Label>Scope</Label>
                <SelectScope v-model="form.scope" :scopes="scopes"/>
                <Label variant="error">{{form.errors.scope}}</Label>
            </div>
            <div class="grid gap-2">
                <Label>Description</Label>
                <TextArea v-model="form.description" placeholder="Set an event title in the subject"></TextArea>
                <Label variant="error">{{form.errors.description}}</Label>
            </div>
        </fieldset>
        <template v-slot:cta>
            <Button :loading="form.processing" @click="submit">Add</Button>
        </template>
    </Modal>
</template>

<style scoped>

</style>
