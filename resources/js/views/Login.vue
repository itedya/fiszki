<script setup>
import useAuthStore from "../store/auth.store";
import {ref} from "vue";
import {useRouter} from "vue-router";
import useErrorModal from "../composables/error-modal";

const router = useRouter();

const email = ref();
const password = ref();

const login = async () => {
    const store = useAuthStore();

    await store.login(email.value, password.value)
        .then(async () => {
            await store.fetchUser();
            await router.push("/dashboard");
        })
        .catch(err => useErrorModal().processServerError(err));
}
</script>

<template>
    <div class="flex justify-center items-center h-screen w-screen">
        <div class="p-5 m-5 w-full bg-slate-800 flex flex-col gap-3 rounded-xl">
            <h2 class="text-xl font-thin">Logowanie</h2>

            <input type="text" id="email" class="input" placeholder="Email" v-model="email"/>
            <input type="password" id="password" class="input" placeholder="Hasło" v-model="password"/>

            <button class="px-3 py-2 rounded-xl w-full bg-slate-700 font-semibold hover:bg-slate-600 focus:bg-slate-600"
                    @click="login">
                Zaloguj
            </button>
        </div>
    </div>
</template>
