import Vue, { VueConstructor } from "vue";
import VueRouter from "vue-router";
import HomeComponent from "../components/screen/home.screen.vue";
import LoginComponent from "../components/screen/login.screen.vue";
import ResetComponent from "../components/screen/reset.screen.vue";
import DashboardComponent from "../components/screen/dashboard.screen.vue";

Vue.use(VueRouter);

type RouteName = "home" | "login" | "reset" | "dashboard";
type RoutePath = "/" | "/access-accounts" | "/search-accounts" | "/dashboard";

interface Routes {
    name: RouteName;
    path: RoutePath;
    component: VueConstructor<Vue>;
}

const routes: Routes[] = [
    {
        name: "home",
        path: "/",
        component: HomeComponent
    },
    {
        name: "login",
        path: "/access-accounts",
        component: LoginComponent
    },
    {
        name: "reset",
        path: "/search-accounts",
        component: ResetComponent
    },
    {
        name: "dashboard",
        path: "/dashboard",
        component: DashboardComponent
    }
];

const router = new VueRouter({ routes });

const authenticate = ["dashboard"];
const unauthenticate = ["login", "reset"];

router.beforeEach((to, from, next) => {
    if (localStorage.getItem("token")) {
        if (unauthenticate.includes(to.name)) {
            next({ name: "home" });
        } else {
            next();
        }
    } else {
        if (authenticate.includes(to.name)) {
            next({ name: "login" });
        } else {
            next();
        }
    }
});

export default router;
