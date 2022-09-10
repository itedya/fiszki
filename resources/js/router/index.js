import {createRouter, createWebHistory} from "vue-router";
import routes from "./routes";
import useRouteValidation from "../composables/route-validation";

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const validator = useRouteValidation();

    const {pass: canGo, redirect} = validator.validateRoute(to);

    if (!canGo) {
        return next(redirect);
    }

    next();
})

export default router;
