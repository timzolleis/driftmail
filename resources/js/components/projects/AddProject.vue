<template>
    <Button @click="openModal"><Plus class="h-4 w-4"/>Add project</Button>
    <Modal :show="showModal" @close="closeModal">
        <template v-slot:title>Add project</template>
       <fieldset class="grid gap-4">
           <div class="grid gap-2">
               <Label>Project name</Label>
               <Input placeholder="My project" v-model="form.name" />
               <Label variant="error">{{form.errors.name}}</Label>
           </div>
           <div class="grid gap-2">
               <Label>Description</Label>
               <TextArea v-model="form.description" placeholder="This is a project for sending emails!"></TextArea>
               <Label variant="error">{{form.errors.description}}</Label>
           </div>
       </fieldset>
        <template v-slot:cta>
            <Button :loading="form.processing" @click="submit">Add</Button>
        </template>
    </Modal>



</template>

<script setup lang="ts">
import TextInput from "../form/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import BlackButton from "../common/BlackButton.vue";
import Input from "../ui/Input.vue";
import Label from "../ui/Label.vue";
import TextArea from "../ui/TextArea.vue";
import {useModal} from "../../composables/modal";
import Button from "../ui/Button.vue";
import {Plus} from "lucide-vue-next";
import Modal from "../common/Modal.vue";

const form = useForm({
    name: "",
    description: "",
});
const {showModal, openModal, closeModal} = useModal()


const emit = defineEmits(["success"]);

function submit() {
    form.post("/project/new", {
        onSuccess: () => closeModal()
    });
}
</script>

<style scoped></style>
