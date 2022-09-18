<script setup>
import {useRoute} from "vue-router";
import useFlashcardFoldersStore from "../../store/flashcard-folders.store";
import {ref} from "vue";
import CreateFlashcardCard from "../../components/Flashcards/Create.vue";

const route = useRoute();
const id = parseInt(route.params.id);

const {fetchFlashcardFolder, flashcardFolders} = useFlashcardFoldersStore();

const getFlashcardFolder = () => Object.values(flashcardFolders.value).find(ele => ele.id === id);

let flashcardFolder = ref(getFlashcardFolder());

if (id && (flashcardFolder.value === undefined || flashcardFolder.value.flashcards === undefined)) {
    fetchFlashcardFolder(id, true)
        .then(() => flashcardFolder.value = getFlashcardFolder());
}

const createFlashcard = (data) => {
    flashcardFolder.value.flashcards.push(data);
}
</script>

<template>
    <div class="container pt-16">
        <div class="p-5 flex flex-col gap-5" v-if="flashcardFolder">
            <h3 class="text-3xl font-extrabold px-3">{{ flashcardFolder.name }}</h3>

            <div v-for="flashcard of flashcardFolder.flashcards" :key="flashcard.id" class="card">
                <p>{{ flashcard.front }}</p>
                <hr class="mx-1 opacity-50"/>
                <p>{{ flashcard.back }}</p>
            </div>

            <CreateFlashcardCard :flashcard-folder-id="id" @create-flashcard="createFlashcard"/>
        </div>
    </div>
</template>
