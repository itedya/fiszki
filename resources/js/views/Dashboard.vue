<template>
    <div class="container pt-16 pb-5 px-5 flex flex-col gap-5">
        <h2 class="text-center text-2xl font-semibold py-5">Witaj ponownie, pouczymy się czegoś? 😄</h2>

        <h3 v-if="flashcardFolders.length === 0" class="text-3xl text-center">
            Brak utworzonych folderów z fiszkami
        </h3>

        <button class="btn-w-full bg-slate-800 hover:bg-slate-900" @click="createFolder">
            Stwórz folder
        </button>

        <div v-if="flashcardFolders.length !== 0" class="flex flex-col justify-content-center gap-5">
            <div class="card hover:scale-105 duration-300" v-for="folder in flashcardFolders" @click="showFolderInfo(folder.id)">
                <h3 class="text-xl font-semibold">{{ folder.name }}</h3>
            </div>
        </div>
    </div>
</template>

<script>
import useFlashcardFoldersStore from "../store/flashcard-folders.store";
import {ref} from "vue";
import {useRouter} from "vue-router";

export default {
    setup() {
        const {fetchFlashcardFolders, getFlashcardFolders} = useFlashcardFoldersStore();
        const router = useRouter();

        const flashcardFolders = ref([]);

        fetchFlashcardFolders(null)
            .then(() => flashcardFolders.value = getFlashcardFolders());

        const createFolder = () => {
            router.push("/flashcard-folders/create");
        }

        const showFolderInfo = (id) => {
            router.push("/flashcard-folders/" + id);
        }

        return {flashcardFolders, createFolder, showFolderInfo};
    }
}
</script>
