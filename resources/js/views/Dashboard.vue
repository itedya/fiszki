<template>
    <div class="container pt-16">
        <div class="w-full">
            <h2 class="text-center text-2xl font-semibold py-5">Witaj ponownie, pouczymy się czegoś? 😄</h2>
        </div>

        <div v-if="flashcardFolders.length === 0" class="flex justify-content-center items-center flex-col gap-3">
            <h3 class="text-3xl px-5 text-center">Brak utworzonych folderów z fiszkami</h3>
            <button class="btn bg-slate-800 focus:bg-slate-900 hover:bg-slate-900" @click="createFolder">Stwórz
                folder
            </button>
        </div>

        <div v-else class="flex flex-col justify-content-center">
            <div class="w-full" v-for="folder in flashcardFolders">
                <h3>{{ folder.name }}</h3>
                <p>Ilość fiszek: <!-- TODO --></p>
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

        fetchFlashcardFolders()
            .then(() => flashcardFolders.value = getFlashcardFolders());

        const createFolder = () => {

            // router.push("") TODO: Jak utworzysz to
        }

        return {flashcardFolders, createFolder};
    }
}
</script>
