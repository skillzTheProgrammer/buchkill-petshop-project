import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import AdminView from "@/views/AdminView.vue";
import ProductView from "@/views/ProductView.vue";
import { useAuthStore } from "@/composables/useAuthStore";
import { TOKEN_ID } from "@/constant";

export const HOME_ROUTE = "/";
export const CUSTOMERS_ROUTE = "/admin/customers";
export const PRODUCT_ROUTE = "/admin/products";

const routes: Array<RouteRecordRaw> = [
  {
    path: HOME_ROUTE,
    name: "admin",
    component: AdminView,
  },
  {
    path: PRODUCT_ROUTE,
    name: "adminProduct",
    component: ProductView,
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
