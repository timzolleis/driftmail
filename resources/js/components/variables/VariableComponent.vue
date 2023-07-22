<template>
    <div
        class="flex items-center justify-between w-full rounded-md border p-3 px-5 text-sm"
    >
        <div class="flex items-start">
            <div>
                <div class="flex gap-2 items-center">
                    <p class="font-medium">{{ variable.key }}</p>
                </div>
                <p class="text-muted-foreground text-xs leading-4 truncate">
                    {{ variable.description }}
                </p>
            </div>

        </div>
        <div class="flex items-center">
            <Badge variant="secondary">
                {{scopes.find(scope => scope.value === variable.scope)?.name}}
            </Badge>
           <Dropdown>
               <DropdownItem>
                   <Link :href="`variables/${variable.id}`">Edit</Link>
               </DropdownItem>
               <DropdownItem>
                   <Link class="text-red-500">Delete</Link>
               </DropdownItem>
           </Dropdown>
        </div>

        <AlertDialogRoot>
            <AlertDialogTrigger
                class="bg-white text-grass11 font-semibold hover:bg-white/90 shadow-sm inline-flex h-[35px] items-center justify-center rounded-[4px] px-[15px] leading-none outline-none focus:shadow-[0_0_0_2px] focus:shadow-black transition-all"
            >Delete account
            </AlertDialogTrigger>
            <AlertDialogPortal>
                <AlertDialogOverlay class="alert-dialog-overlay" />
                <AlertDialogContent
                    class="alert-dialog-content"
                >
                    <AlertDialogTitle class="text-mauve12 m-0 text-[17px] font-semibold"> Are you absolutely sure? </AlertDialogTitle>
                    <AlertDialogDescription class="text-mauve11 mt-4 mb-5 text-[15px] leading-normal">
                        This action cannot be undone. This will permanently delete your account and remove your data from our servers.
                    </AlertDialogDescription>
                    <div class="flex justify-end gap-[25px]">
                        <AlertDialogCancel
                            class="text-mauve11 bg-mauve4 hover:bg-mauve5 focus:shadow-mauve7 inline-flex h-[35px] items-center justify-center rounded-[4px] px-[15px] font-semibold leading-none outline-none focus:shadow-[0_0_0_2px]"
                        >
                            Cancel
                        </AlertDialogCancel>
                        <AlertDialogAction
                            @click="handleAction"
                            class="text-red11 bg-red4 hover:bg-red5 focus:shadow-red7 inline-flex h-[35px] items-center justify-center rounded-[4px] px-[15px] font-semibold leading-none outline-none focus:shadow-[0_0_0_2px]"
                        >
                            Yes, delete account
                        </AlertDialogAction>
                    </div>
                </AlertDialogContent>
            </AlertDialogPortal>
        </AlertDialogRoot>


    </div>
</template>

<script setup lang="ts">
import {Variable} from "../../models/Variable";
import {DropdownOption} from "../../models/Select";
import {ref} from "@vue/reactivity";
import {Project} from "../../models/Project";
import {scopes} from "../../config/props";
import ConfirmationModal from "../common/ConfirmationModal.vue";
import {Link, router, usePage} from "@inertiajs/vue3";
import {useDynamicUrl} from "../../composables/navigation";
import Badge from "../ui/Badge.vue";
import Dropdown from "../ui/Dropdown.vue";
import DropdownItem from "../ui/dropdown/DropdownItem.vue";

import {
    AlertDialogCancel,
    AlertDialogContent, AlertDialogDescription,
    AlertDialogOverlay,
    AlertDialogPortal,
    AlertDialogRoot, AlertDialogTitle,
    AlertDialogTrigger
} from "radix-vue";
const pageProps = usePage().props;



const props = defineProps<{
    project: Project;
    variable: Variable;
}>();

const showDeleteModal = ref(false);
const options: DropdownOption[] = [
    {
        name: "Edit",
        emit: "edit",
    },
    {
        name: "Delete",
        emit: "delete",
        color: "text-red-500",
    },
];
</script>

<style scoped></style>
