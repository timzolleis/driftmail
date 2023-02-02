import { VueElement } from "@vue/runtime-dom";

export type SelectOption = {
    id: string;
    name: string;
    value: string;
    icon?: any;
};

export type DropdownOption = {
    name: string;
    emit: string;
    color?: string;
};
