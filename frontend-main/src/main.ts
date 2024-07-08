import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import pinia from "./composables";
import PrimeVue from "primevue/config";
import "primevue/resources/themes/saga-blue/theme.css"; // Theme
import "primevue/resources/primevue.min.css"; // Core CSS
import "primeicons/primeicons.css"; // Icons
// import "primeflex/primeflex.css";
import "./index.css";

const app = createApp(App);

app.use(PrimeVue);
app.use(pinia);
app.use(router);
app.mount("#app");
