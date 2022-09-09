import axios from "axios";
import useAuthStore from "./auth.store";

const api = axios.create({
    baseURL: "/api",
    withCredentials: true,
    xsrfHeaderName: 'X-CSRF-TOKEN'
});

api.interceptors.request.use((config) => {
    const store = useAuthStore();
    config.headers.Authorization = `Bearer ${store.token.value}`;
    return config;
})

export default api;
