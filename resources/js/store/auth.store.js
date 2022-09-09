import api from "./api";
import useLocalstorageDriver from "../composables/localstorage-driver";

const useAuthStore = () => {
    const csrf = useLocalstorageDriver("csrf");
    const token = useLocalstorageDriver("token");
    const user = useLocalstorageDriver("user");

    const fetchCSRF = () => {
        return api.get("/auth/csrf")
            .then(res => {
                csrf.value = res.data;
                api.defaults.headers['X-CSRF-TOKEN'] = csrf.value;
                return csrf.value;
            })
    }

    const login = (email, password) => {
        return api.post("/auth/login", {email, password})
            .then(res => {
                const data = res.data;
                token.value = data.token;
                return data;
            });
    }

    const register = (email, password) => {
        return api.post("/auth/register", {email, password});
    }

    const fetchUser = () => {
        return api.get("/auth/user")
            .then(res => {
                user.value = res.data;
                return user.value;
            });
    }

    return {csrf, token, user, fetchUser, register, login, fetchCSRF};
}

export default useAuthStore;
