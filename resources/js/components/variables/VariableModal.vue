<template>
    <div>
        <Teleport to="body">
            <Modal
                :show="showModal"
                @close="navigateBack"
                :title="`${intent} Variable`"
            >
                <VariableFormComponent
                    @save="(form) => handleSave(form)"
                    :intent="intent"
                    :variable="variable"
                ></VariableFormComponent>
            </Modal>
        </Teleport>
    </div>
</template>

<script setup lang="ts">
import Modal from "../common/Modal.vue";
import VariableFormComponent from "./VariableFormComponent.vue";
import {Variable} from "../../models/Variable";
import {computed, ref} from "@vue/reactivity";
import {createVariable, saveVariable, VariableForm} from "../../composables/variable";
import {router} from "@inertiajs/vue3";
import {useDynamicUrl} from "../../composables/navigation";

const props = defineProps<{
    variable: Variable | null,
}>()

const showModal = computed(() => {
    return !!props.variable || checkModalSearchParams()
})
const intent = computed(() => {
    if (props.variable) {
        return "Edit"
    }
    return "Add"
})

function checkModalSearchParams() {
    const searchParams = new URLSearchParams(window.location.search)
    const isOpen = searchParams.get("modal")
    return isOpen === "true"
}

function closeModalSearchParams() {
    const searchParams = new URLSearchParams(window.location.search)
    searchParams.delete("modal")
    window.location.search = searchParams.toString();
}


function handleSave(form: VariableForm) {
    if (props.variable) {
        saveVariable(form, props.variable.id, () => navigateBack())
    } else {
        createVariable(form, () => navigateBack())
    }
}

function navigateBack() {
    if(checkModalSearchParams()){
        closeModalSearchParams()
    }

    return router.get(useDynamicUrl('/project/{id}', '/variables'), {}, {preserveState: true})
}


</script>

<style scoped>

</style>
