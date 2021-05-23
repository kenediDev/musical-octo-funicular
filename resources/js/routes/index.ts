import Vue, { VueConstructor } from "vue";
import VueRouter from "vue-router";
import HomeComponent from "../components/screen/home.screen.vue";

Vue.use(VueRouter);

type RouteName = "home";
type RoutePath = "/";

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
    }
];

const router = new VueRouter({ routes });

export default router;
