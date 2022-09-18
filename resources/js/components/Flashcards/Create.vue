<template>
    <div class="card">
        <h3 class="card-title">Stwórz fiszkę</h3>
        <input type="text" class="input" v-model="front" placeholder="Przód"/>
        <input type="text" class="input" v-model="back" placeholder="Tył"/>
        <button class="card-w-full-btn bg-slate-800 hover:bg-slate-900" @click="create">Stwórz</button>
    </div>
</template>

<script>
import {ref} from "vue";
import useFlashcardFoldersStore from "../../store/flashcard-folders.store";
import useErrorModal from "../../composables/error-modal";

export default {
    props: {
        flashcardFolderId: Number
    },

    setup(props, {emit}) {
        const front = ref();
        const back = ref();

        const create = () => {
            const {createFlashcard} = useFlashcardFoldersStore();

            createFlashcard(front.value, back.value, props.flashcardFolderId)
                .then(res => emit("create-flashcard", res))
                .catch(err => useErrorModal().processServerError(err));
        }

        return {front, back, create}
    }
}
</script>

<style scoped>

</style>
