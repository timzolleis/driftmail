import {Variable} from "../models/Variable";
import {router, useForm} from "@inertiajs/vue3";
import {scopes} from "../config/props";
import {useDynamicUrl} from "./navigation";

export function useVariableForm(variable?: Variable) {
    if (variable) {
        return useForm({
            key: variable.key,
            value: variable.value,
            description: variable.description,
            scope: scopes.find((scope) => scope.value === variable.scope),
        });
    }
    return useForm({
        key: "",
        value: "",
        description: "",
        scope: scopes[0],
    });
}

export type VariableForm = ReturnType<typeof useVariableForm>;


export function saveVariable(form: VariableForm, variableId: string, successCallback: Function = () => void(0)) {
    return form.put(useDynamicUrl('/project/{id}', `/variables/${variableId}`), {
        onSuccess: () => successCallback()
    })
}

export function createVariable(form: VariableForm,  successCallback: Function = () => void(0)) {
    return form.post(useDynamicUrl('/project/{id}', '/variables/new'), {
        onSuccess: () => successCallback()
    })
}

export function deleteVariable(variableId: string, successCallback: Function = () => void(0)) {
    return router.delete(useDynamicUrl('/project/{id}', `/variable/${variableId}`), {
        onSuccess: () => successCallback()
    })
}
