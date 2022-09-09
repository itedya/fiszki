import {createApp} from "vue";
import App from "./App.vue";
import router from "./router";
import useAuthStore from "./store/auth.store";

const init = async () => {
    const app = createApp(App)
        .use(router);

    const authStore = useAuthStore();

    if (!authStore.csrf.value) {
        await authStore.fetchCSRF();
    }

    if (authStore.token.value) {
        await authStore.fetchUser();
    }

    app.mount("#app");
}

init();
