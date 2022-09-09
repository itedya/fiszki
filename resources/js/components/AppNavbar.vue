<script setup>

import {ref} from "vue";

const routes = ref([
    {path: "/", name: "Strona główna", icon: "home.svg"},
    {path: "/auth/login", name: "Logowanie", icon: "log-in.svg"},
    {path: "/auth/register", name: "Rejestracja", icon: "user-plus.svg"}
]);

const active = ref(false);
</script>

<template>
    <div class="fixed top-0 flex flex-row z-20 w-screen p-3 justify-between items-center bg-slate-800">
        <h1 class="font-bold text-3xl px-4">Fiszki</h1>
        <div class="p-2 bg-slate-700 rounded-lg" @click="active = !active">
            <img src="/icons/menu.svg" alt="Menu"/>
        </div>
    </div>

    <div :class="['z-30 flex flex-col h-screen w-screen fixed bg-gray-800 p-6', active || '-left-full']">
        <router-link v-for="item in routes" :to="item.path" @click="active = !active"
                     class="text-slate-300 text-semibold hover:text-slate-400 py-2 px-4 my-1 rounded-xl hover:bg-gray-700 flex flex-row gap-3">
            <img :src="`/icons/${item.icon}`" :alt="item.name"/>
            {{ item.name }}
        </router-link>
    </div>
</template>
