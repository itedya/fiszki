import useLocalstorageDriver from "../composables/localstorage-driver";
import useAxiosApi from "./api";

const csrf = useLocalstorageDriver("csrf");
const token = useLocalstorageDriver("token");
const user = useLocalstorageDriver("user", true);

const fetchCSRF = () => {
    const api = useAxiosApi();
    return api.get("/auth/csrf")
        .then(res => {
            csrf.value = res.data;
            return csrf.value;
        })
}

const login = (email, password) => {
    const api = useAxiosApi();
    return api.post("/auth/login", {email, password})
        .then(res => {
            const data = res.data;
            token.value = data.token;
            return data;
        });
}

const register = (email, password) => {
    const api = useAxiosApi();
    return api.post("/auth/register", {email, password});
}

const fetchUser = () => {
    const api = useAxiosApi();
    return api.get("/auth/user")
        .then(res => {
            user.value = res.data;
            return user.value;
        });
}

const useAuthStore = () => {
    return {csrf, token, user, fetchUser, register, login, fetchCSRF};
}

export default useAuthStore;
