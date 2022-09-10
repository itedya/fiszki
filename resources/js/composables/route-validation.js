import useAuthStore from "../store/auth.store";
import RouteAuth from "../enums/route-auth";
import {useRouter} from "vue-router";

const useRouteValidation = () => {
    const validateRoute = (route) => {
        const store = useAuthStore();
        const user = store.user.value;

        switch (route.meta.auth) {
            case RouteAuth.MUST_BE_UNAUTHORIZED:
                if (!!user) return {pass: false, redirect: "/dashboard"};
                break;
            case RouteAuth.MUST_BE_AUTHORIZED:
                if (!!user === false) return {pass: false, redirect: "/auth/login"};
                break;
            case RouteAuth.NOT_RELIABLE_ON_AUTHORIZATION:
                return {pass: true};
            default:
                throw new Error("Wrong route auth value!");
        }

        return {pass: true};
    }

    const getFilteredRoutes = () => {
        const router = useRouter();
        const routes = router.getRoutes();

        return routes.filter(ele => validateRoute(ele));
    }

    return {validateRoute, getFilteredRoutes}
}

export default useRouteValidation;
