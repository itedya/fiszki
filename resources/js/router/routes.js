import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import Dashboard from "../views/Dashboard.vue";
import RouteAuth from "../enums/route-auth";

export default [
    {
        path: "/",
        component: Home,
        name: "Strona główna",
        meta: {
            icon: "home.svg",
            auth: RouteAuth.MUST_BE_UNAUTHORIZED
        }
    },
    {
        path: "/auth/login",
        component: Login,
        name: "Logowanie",
        meta: {
            icon: "log-in.svg",
            auth: RouteAuth.MUST_BE_UNAUTHORIZED
        }
    },
    {
        path: "/auth/register",
        component: Register,
        name: "Rejestracja",
        meta: {
            icon: "user-plus.svg",
            auth: RouteAuth.MUST_BE_UNAUTHORIZED
        }
    },
    {
        path: "/dashboard",
        component: Dashboard,
        name: "Dashboard",
        meta: {
            icon: "list.svg",
            auth: RouteAuth.MUST_BE_AUTHORIZED
        }
    }
]
