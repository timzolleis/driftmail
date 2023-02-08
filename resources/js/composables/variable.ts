import { Variable } from "../models/Variable";
import { useForm } from "@inertiajs/vue3";

export function useVariableForm(variable?: Variable) {
    if (variable) {
        return useForm({
            key: variable.key,
            value: variable.value,
            description: variable.description,
            scope: variable.scope,
        });
    }
    return useForm({
        key: "",
        value: "",
        description: "",
        scope: "global:all",
    });
}

export type VariableForm = ReturnType<typeof useVariableForm>;
