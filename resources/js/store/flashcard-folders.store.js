import {ref} from "vue";
import api from "./api";
import useAuthStore from "./auth.store";

const flashcardFolders = ref({});

const fetchFlashcardFolders = (userId = null) => {
    const params = userId === null ? {} : {userId};

    return api.get(`/flashcard-folders`, {params})
        .then(({data}) => {
            data.forEach(flashcard => flashcardFolders.value[flashcard.id] = flashcard);

            return data;
        });
}

const getFlashcardFolders = (userId = null) => {
    if (userId === null) {
        const authStore = useAuthStore();
        userId = authStore.user.value.id;
    }

    return Object.values(flashcardFolders.value).filter(ele => ele.userId === userId);
}

const useFlashcardFoldersStore = () => {
    return {fetchFlashcardFolders, getFlashcardFolders};
}

export default useFlashcardFoldersStore;
