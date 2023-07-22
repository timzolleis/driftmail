import { defineProps, defineEmits } from '@vue/runtime-core';
import { router } from '@inertiajs/vue3';
import { ref } from '@vue/reactivity';

export function useComponentVModel(propOptions?: Object) {
    const props = defineProps<{ modelValue: string }>();
    const emit = defineEmits<{ (e: 'update:modelValue', value: string): void }>();
    return { props, emit };
}

export function useRouterLoading() {
    const isRouterLoading = ref(false);
    const id = ref(getId());
    router.on('start', (event) => {
        const target = event.target as Document;
        if (
            id.value === target.activeElement?.id ||
            id.value === target.activeElement?.parentElement?.id
        ) {
            isRouterLoading.value = true;
        }
    });
    return { id, isRouterLoading };
}

function getId() {
    return (Math.random() + 1).toString(36).substring(7);
}
