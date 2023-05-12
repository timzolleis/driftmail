<template>
    <div>
        <Teleport to="body">
            <Modal
                :show="showModal"
                @close="navigateBack"
                :title="`${variable? 'Edit' : 'Add'} Variable`"
            >
                <VariableFormComponent v-model="form"
                                       :intent="variable? 'Edit' : 'Add'"
                                       :variable="variable"
                ></VariableFormComponent>
                <template v-slot:secondary-action>
                    <StyledButton  @click="navigateBack"
                                  variant="ghost">Cancel
                    </StyledButton>
                </template>
                <template v-slot:primary-action>
                    <StyledButton :loading="form.processing" @click="handleSave">Save</StyledButton>
                </template>
            </Modal>
        </Teleport>
    </div>
</template>
<script setup lang="ts">
import Modal from "../common/Modal.vue";
import VariableFormComponent from "./VariableFormComponent.vue";
import {Variable} from "../../models/Variable";
import {computed} from "@vue/reactivity";
import {createVariable, saveVariable, useVariableForm} from "../../composables/variable";
import {router} from "@inertiajs/vue3";
import {useNegativeNavigation} from "../../composables/navigation";
import StyledButton from "../StyledButton.vue";

const props = defineProps<{
    variable: Variable | undefined,
    add: boolean
}>()
const form = computed(() => {
    return useVariableForm(props.variable)
})

const showModal = computed(() => {
    return !!props.variable || props.add
})

function handleSave() {
    if (props.variable) {
        saveVariable(form.value, props.variable.id, () => navigateBack())
    } else {
        createVariable(form.value, () => navigateBack())
    }
}
function navigateBack() {
    router.get(useNegativeNavigation(1), {}, {preserveState: true})
}

</script>

<style scoped>

</style>
