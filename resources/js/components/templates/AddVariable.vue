<script setup lang="ts">

import {ref} from "@vue/reactivity";
import {Variable} from "../../models/Variable";
import axios from "axios";
import {getParametersFromRoute} from "../../composables/navigation";
import {onMounted} from "@vue/runtime-core";
import {Loader2} from "lucide-vue-next";
import CardContainer from "../../Shared/Layout/CardContainer.vue";
import TextInput from "../form/TextInput.vue";
import Label from "../Label.vue";
import Badge from "../Badge.vue";

const isLoading = ref(true)
const results = ref<Variable[]>([])
const search = ref("")
const emit = defineEmits<{ (e: "insert", value: string): void }>()

function loadVariables() {
    const parameters = getParametersFromRoute('/project/$projectId')
    const projectId = parameters.projectId
    if (!projectId) {
        throw new Error("Error reading projectId")
    }
    axios.get(`/api/variables/search/${projectId}`).then(res => {
        results.value = res.data
        isLoading.value = false
    })
}

function filterResults() {
    return results.value.filter(element => element.value.toLowerCase().includes(search.value.toLowerCase()))
}

function insertLink(value: string) {
    emit("insert", `{${value}}`)
}


onMounted(() => loadVariables())


</script>

<template>
    <section>
        <CardContainer v-if="isLoading">
            <div class="flex flex-col items-center">
                <Loader2 class="animate-spin stroke-gray-800"></Loader2>
                <p class="text-sm text-gray-900 font-medium">Loading variables</p>
            </div>
        </CardContainer>
        <Label>Search</Label>
        <TextInput v-model="search"></TextInput>
        <Label>Results</Label>
        <div class="p-2 rounded-md border mt-2">
            <div
                @click="insertLink(result.value)"
                class="hover:bg-gray-50 hover:cursor-pointer px-2 py-2 rounded-md text-sm text-gray-900 flex items-center gap-2 font-medium "
                v-for="result in filterResults()" :key="result.id">
                <p>{{ result.value }}</p>
                <Badge>{{ result.scope }}</Badge>
            </div>
            <div v-if="filterResults().length === 0">
                <p class="text-sm text-gray-900 font-medium text-center">No results</p>
            </div>
        </div>
    </section>


</template>

<style scoped>

</style>
