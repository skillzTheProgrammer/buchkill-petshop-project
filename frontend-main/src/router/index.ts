import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import AdminView from "../views/AdminView.vue";
import { useAuthStore } from "@/composables/useAuthStore";
import { TOKEN_ID } from "@/constant";

const routes: Array<RouteRecordRaw> = [
  {
    path: "/",
    name: "admin",
    component: AdminView,
  },
  // {
  //   path: "/about",
  //   name: "about",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../views/AboutView.vue"),
  // },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

// Navigation guard
router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();
  const token = localStorage.getItem(TOKEN_ID);
  if (!token) {
    authStore.showLogin(); // Show login modal
    next(false); // Cancel navigation
  } else {
    next();
  }
});

export default router;
