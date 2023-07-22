import { ref } from '@vue/reactivity';

export function useModal() {
    const showModal = ref(false);
    const openModal = () => {
        showModal.value = true;
    };
    const closeModal = () => {
        showModal.value = false;
    };

    const toggleModal = () => {
        showModal.value = !showModal.value;
    };

    return { showModal, openModal, closeModal, toggleModal };
}
