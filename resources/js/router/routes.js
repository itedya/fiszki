import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
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
    }
]
