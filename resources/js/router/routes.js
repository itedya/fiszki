import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import Dashboard from "../views/Dashboard.vue";
import RouteAuth from "../enums/route-auth";

export default [
    {
        path: "/",
        component: Home,
        meta: {
            auth: RouteAuth.MUST_BE_UNAUTHORIZED
        }
    },
    {
        path: "/auth/login",
        component: Login,
        meta: {
            auth: RouteAuth.MUST_BE_UNAUTHORIZED
        }
    },
    {
        path: "/auth/register",
        component: Register,
        meta: {
            auth: RouteAuth.MUST_BE_UNAUTHORIZED
        }
    },
    {
        path: "/dashboard",
        component: Dashboard,
        meta: {
            auth: RouteAuth.MUST_BE_AUTHORIZED
        }
    }
]
