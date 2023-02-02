import { SelectOption } from "../models/Select";

export const scopes: SelectOption[] = [
    {
        id: "scopes.global.all",
        name: "Global - All",
        value: "global:all",
    },
    {
        id: "scopes.global.subject",
        name: "Global - Subject",
        value: "global:subject",
    },
    {
        id: "scopes.global.body",
        name: "Global - Body",
        value: "global:body",
    },
    {
        id: "scopes.user.all",
        name: "User - All",
        value: "user:all",
    },
    {
        id: "scopes.user.subject",
        name: "User - Subject",
        value: "user:subject",
    },
    {
        id: "scopes.user.body",
        name: "User - Body",
        value: "user:body",
    },
];
