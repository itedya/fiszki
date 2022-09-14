import {createApp} from "vue";
import App from "./App.vue";
import router from "./router";
import useAuthStore from "./store/auth.store";

const init = async () => {
    const authStore = useAuthStore();

    if (!authStore.csrf.value) {
        await authStore.fetchCSRF();
    }

    if (authStore.token.value) {
        await authStore.fetchUser();
    } else {
        authStore.user.value = null;
    }

    createApp(App)
        .use(router)
        .mount("#app");
}

init();
