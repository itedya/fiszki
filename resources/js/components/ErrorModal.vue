<script setup>
import {ref} from "vue";
import emitter from "../emitter";

const active = ref(false);

const text = ref();

emitter.on("error:modal:show", (data) => {
    text.value = data;
    active.value = true;
});

emitter.on("error:modal:hide", () => {
    active.value = false;
});
</script>

<template>
    <div
        :class="['z-50 fixed top-0 left-0 w-screen h-screen bg-slate-900 bg-opacity-80 flex justify-center items-center', active || 'hidden']">
        <div class="p-5 m-5 w-full bg-slate-800 flex flex-col gap-3 rounded-xl">
            <h2 class="text-2xl font-semibold">Wystąpił błąd</h2>

            <p v-html="text"></p>

            <button class="px-3 py-2 rounded-xl w-full bg-slate-700 font-semibold bg-red-800 focus:bg-red-700"
                    @click="active = !active">Zamknij
            </button>
        </div>
    </div>
</template>
