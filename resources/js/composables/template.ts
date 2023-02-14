import { Template } from "../models/Template";
import { useForm } from "@inertiajs/vue3";

export function useTemplateForm(template?: Template) {
    if (template) {
        return useForm({
            name: template.name,
            description: template.description,
            subject: template.subject,
            body: template.body,
        });
    }
    return useForm({
        name: "",
        description: "",
        subject: "",
        body: "",
    });
}

export type TemplateForm = ReturnType<typeof useTemplateForm>;
