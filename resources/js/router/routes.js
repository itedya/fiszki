import Home from "../views/Home.vue";
import Login from "../views/Login.vue";

export default [
    {
        path: "/",
        component: Home
    },
    {
        path: "/auth/login",
        component: Login
    }
]
