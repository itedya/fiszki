import {ref} from "vue";
import useAuthStore from "./auth.store";
import useAxiosApi from "./api";

const flashcardFolders = ref({});

const fetchFlashcardFolders = (userId = null, withFlashcards = false) => {
    const api = useAxiosApi();
    const params = userId === null ? {} : {userId};

    params.with_flashcards = withFlashcards ? 1 : 0;

    return api.get(`/flashcard-folders`, {params})
        .then(({data}) => {
            data.forEach(flashcard => flashcardFolders.value[flashcard.id] = flashcard);
            return data;
        });
}

const fetchFlashcardFolder = (id, withFlashcards = false) => {
    const api = useAxiosApi();

    withFlashcards = withFlashcards ? 1 : 0;

    return api.get(`/flashcard-folders`, {
        params: {id, with_flashcards: withFlashcards}
    })
        .then(({data}) => {
            flashcardFolders.value[id] = data;
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

const createFlashcard = (front, back, flashcardFolderId) => {
    const api = useAxiosApi();
    return api.post('/flashcards', {front, back, folder_id: flashcardFolderId})
        .then(({data}) => {
            flashcardFolders.value[flashcardFolderId] = data;
            return data;
        });
}

const createFlashcardFolder = (name, userId = null) => {
    const api = useAxiosApi();
    const payload = {name};
    if (userId !== null) payload.user_id = userId;

    return api.post("/flashcard-folders", payload);
}

const useFlashcardFoldersStore = () => {
    return {
        fetchFlashcardFolders,
        getFlashcardFolders,
        createFlashcardFolder,
        fetchFlashcardFolder,
        createFlashcard,
        flashcardFolders
    };
}

export default useFlashcardFoldersStore;
