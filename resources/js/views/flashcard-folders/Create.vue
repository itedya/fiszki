<script setup>
import useFlashcardFoldersStore from "../../store/flashcard-folders.store";
import useInfoModal from "../../composables/info-modal";
import {ref} from "vue";
import useErrorModal from "../../composables/error-modal";
import {useRouter} from "vue-router";

const router = useRouter();
const name = ref();

const create = () => {
    const {createFlashcardFolder} = useFlashcardFoldersStore();

    createFlashcardFolder(name.value)
        .then(() => {
            useInfoModal().showModal("Sukces!", `Stworzono folder o nazwie ${name.value}`);
            router.push("/dashboard");
        })
        .catch(err => useErrorModal().processServerError(err));
}
</script>

<template>
    <div class="container pt-16">
        <div class="card">
            <h2 class="card-title">Stwórz folder z fiszkami</h2>

            <input type="text" class="input" placeholder="Nazwa folderu" v-model="name"/>

            <button class="card-w-full-btn" @click="create">
                Stwórz folder
            </button>
        </div>
    </div>
</template>
