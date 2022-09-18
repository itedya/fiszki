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

const teachTraditionally = () => {

}

const teachGradually = () => {

}
</script>

<template>
    <div class="container pt-16 mx-auto">
        <div class="p-5 flex flex-col flex-wrap gap-5" v-if="flashcardFolder">
            <h3 class="text-3xl font-extrabold px-3">{{ flashcardFolder.name }}</h3>

            <div class="flex gap-5">
                <div class="card flex flex-col justify-center items-center w-1/2 square cursor-pointer hover:scale-105 duration-300 hover:shadow" @click="teachGradually">
                    <p class="font-bold text-2xl">Ucz się</p>
                    <p class="text-sm">Tryb 5 stopniowy</p>
                    <p class="text-xs text-yellow-300 text-center">REKOMENDUJEMY</p>
                </div>
                <div class="card flex flex-col justify-center items-center w-1/2 square cursor-pointer hover:scale-105 duration-300 hover:shadow" @click="teachTraditionally">
                    <p class="font-bold text-2xl">Ucz się</p>
                    <p class="text-sm">Tryb tradycyjny</p>
                </div>
            </div>

            <div v-for="flashcard of flashcardFolder.flashcards" :key="flashcard.id" class="card">
                <p>{{ flashcard.front }}</p>
                <hr class="mx-1 opacity-50"/>
                <p>{{ flashcard.back }}</p>
            </div>

            <CreateFlashcardCard :flashcard-folder-id="id" @create-flashcard="createFlashcard"/>
        </div>
    </div>
</template>
