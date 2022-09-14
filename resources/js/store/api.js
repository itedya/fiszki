import axios from "axios";
import useAuthStore from "./auth.store";

const useAxiosApi = () => {
    const api = axios.create({
        baseURL: "/api",
        withCredentials: true,
        xsrfHeaderName: 'X-CSRF-TOKEN'
    });

    const {csrf, fetchCSRF} = useAuthStore();
    api.defaults.headers.common['X-CSRF-TOKEN'] = csrf.value;

    api.interceptors.request.use((config) => {
        const store = useAuthStore();
        config.headers.Authorization = `Bearer ${store.token.value}`;
        return config;
    })

    api.interceptors.response.use((response) => response, async (error) => {
        const originalRequest = error.config;
        if (error.response.status === 419 && !originalRequest._retry) {
            originalRequest._retry = true;
            originalRequest.headers['X-CSRF-TOKEN'] = await fetchCSRF();
            const newApi = useAxiosApi();
            return newApi(originalRequest);
        }
        return Promise.reject(error);
    });

    return api;
}

export default useAxiosApi;
