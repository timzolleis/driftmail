import {Template} from "../models/Template";
import {useForm} from "@inertiajs/vue3";
import {ProjectSettings} from "../models/Project";
import {useApiKey} from "./key";

export function useSettingsForm(settings?: ProjectSettings) {
    if (settings) {
        return useForm({
            apiKey: settings.api_key,
            mailHost: settings.mail_host,
            mailPort: settings.mail_port,
            mailUser: settings.mail_user,
            mailPassword: settings.mail_password,
            mailSendingAddress: settings.mail_sending_address,
            mailSendingName: settings.mail_sending_name,
            testMailReceiver: settings.test_mail_receiver


        });
    }
    return useForm({
        apiKey: useApiKey(),
        mailHost: "",
        mailPort: "",
        mailUser: "",
        mailPassword: "",
        mailSendingAddress: "",
        mailSendingName: "",
        testMailReceiver: ""
    });
}


export type SettingsForm = ReturnType<typeof useSettingsForm>;
