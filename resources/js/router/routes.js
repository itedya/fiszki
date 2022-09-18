import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import Dashboard from "../views/Dashboard.vue";
import CreateFlashcardFolder from "../views/flashcard-folders/Create.vue";
import FlashcardFolderInfo from "../views/flashcard-folders/Info.vue";
import RouteAuth from "../enums/route-auth";
import NavbarDisplay from "../enums/navbar-display";

export default [
    {
        path: "/",
        component: Home,
        name: "Strona główna",
        meta: {
            icon: "home.svg",
            auth: RouteAuth.MUST_BE_UNAUTHORIZED,
            navbarDisplay: NavbarDisplay.DISPLAY_IN_NAVBAR
        }
    },
    {
        path: "/auth/login",
        component: Login,
        name: "Logowanie",
        meta: {
            icon: "log-in.svg",
            auth: RouteAuth.MUST_BE_UNAUTHORIZED,
            navbarDisplay: NavbarDisplay.DISPLAY_IN_NAVBAR
        }
    },
    {
        path: "/auth/register",
        component: Register,
        name: "Rejestracja",
        meta: {
            icon: "user-plus.svg",
            auth: RouteAuth.MUST_BE_UNAUTHORIZED,
            navbarDisplay: NavbarDisplay.DISPLAY_IN_NAVBAR
        }
    },
    {
        path: "/dashboard",
        component: Dashboard,
        name: "Dashboard",
        meta: {
            icon: "list.svg",
            auth: RouteAuth.MUST_BE_AUTHORIZED,
            navbarDisplay: NavbarDisplay.DISPLAY_IN_NAVBAR
        }
    },
    {
        path: "/flashcard-folders/create",
        component: CreateFlashcardFolder,
        name: "Stwórz folder z fiszkami",
        meta: {
            auth: RouteAuth.MUST_BE_AUTHORIZED,
            navbarDisplay: NavbarDisplay.DO_NOT_DISPLAY_IN_NAVBAR
        }
    },
    {
        path: "/flashcard-folders/:id",
        component: FlashcardFolderInfo,
        name: "Informacje o folderze z fiszkami",
        meta: {
            auth: RouteAuth.MUST_BE_AUTHORIZED,
            navbarDisplay: NavbarDisplay.DO_NOT_DISPLAY_IN_NAVBAR
        }
    }
]
