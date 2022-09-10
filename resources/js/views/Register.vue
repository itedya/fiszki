<script setup>
import useAuthStore from "../store/auth.store";
import {ref} from "vue";
import {useRouter} from "vue-router";
import useErrorModal from "../composables/error-modal";
import useInfoModal from "../composables/info-modal";

const router = useRouter();

const email = ref();
const password = ref();
const repeatedPassword = ref();

const register = async () => {
    const store = useAuthStore();

    await store.register(email.value, password.value)
        .then(() => {
            useInfoModal().showModal("Udało się!", "Pomyślnie zarejestrowano w systemie, teraz zaloguj się danymi które podałeś.");
            router.push("/auth/login");
        })
        .catch(err => useErrorModal().processServerError(err.response));
}
</script>

<template>
    <div class="flex justify-center items-center h-screen w-screen">
        <div class="p-5 m-5 w-full bg-slate-800 flex flex-col gap-3 rounded-xl">
            <h2 class="text-xl font-thin">Logowanie</h2>

            <input type="text" class="input" placeholder="Email" v-model="email"/>
            <input type="password" class="input" placeholder="Hasło" v-model="password"/>
            <input type="password" class="input" placeholder="Powtórz hasło" v-model="repeatedPassword"/>

            <button class="px-3 py-2 rounded-xl w-full bg-slate-700 font-semibold hover:bg-slate-600 focus:bg-slate-600"
                    @click="register">
                Zarejestruj
            </button>
        </div>
    </div>
</template>
