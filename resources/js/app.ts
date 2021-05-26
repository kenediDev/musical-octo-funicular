import Vue from "vue";
import BaseComponent from "./components/base.component.vue";
import router from "./routes";
import store from "./store";
import InlineSvg from "vue-inline-svg";
import "csspin/csspin.css";
import moment from "moment";
import "moment/locale/id";
import VueMoment from "vue-moment";
import { LMap, LTileLayer, LMarker } from "vue2-leaflet";
import "leaflet/dist/leaflet.css";
import VueSmoothScroll from "vue2-smooth-scroll";
Vue.use(VueSmoothScroll);

Vue.component("l-map", LMap);
Vue.component("l-tile-layer", LTileLayer);
Vue.component("l-marker", LMarker);

import { Icon } from "leaflet";

Icon.Default.mergeOptions({
    iconRetinaUrl: require("leaflet/dist/images/marker-icon-2x.png"),
    iconUrl: require("leaflet/dist/images/marker-icon.png"),
    shadowUrl: require("leaflet/dist/images/marker-shadow.png")
});

Vue.component("icon", InlineSvg);

Vue.use(VueMoment, {
    moment
});
const app = new Vue({
    el: "#app",
    router,
    store,
    render: h => h(BaseComponent)
});
