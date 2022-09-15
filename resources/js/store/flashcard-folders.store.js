import {ref} from "vue";
import useAuthStore from "./auth.store";
import useAxiosApi from "./api";

const flashcardFolders = ref({});

const fetchFlashcardFolders = (userId = null) => {
    const api = useAxiosApi();
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

    return Object.values(flashcardFolders.value).filter(ele => ele.owner_id === userId);
}

const createFlashcardFolder = (name, userId = null) => {
    const api = useAxiosApi();
    const payload = {name};
    if (userId !== null) payload.user_id = userId;

    return api.post("/flashcard-folders", payload);
}

const useFlashcardFoldersStore = () => {
    return {fetchFlashcardFolders, getFlashcardFolders, createFlashcardFolder};
}

export default useFlashcardFoldersStore;
