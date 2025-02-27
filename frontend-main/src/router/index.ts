import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import AdminView from "@/views/AdminView.vue";
import ProductView from "@/views/ProductView.vue";
import OrderDetails from "@/views/OrderDetails.vue";
import ProductDetails from "@/views/ProductDetails.vue";
import OrdersView from "@/views/OrdersView.vue";
import { useAuthStore } from "@/composables/useAuthStore";
import { TOKEN_ID } from "@/constant";

export const HOME_ROUTE = "/";
export const CUSTOMERS_ROUTE = "/admin/customers";
export const PRODUCT_ROUTE = "/admin/products";
export const PRODUCT_DETAILS_ROUTE = "/admin/product/:uuid";
export const getProductDetailsRoute = (uuid: string) => `/admin/product/${uuid}`;
export const ORDERS_ROUTE = "/admin/orders";
export const ORDER_DETAILS_ROUTE = "/admin/order/:uuid";
export const getOrdersDetailsRoute = (uuid: string) => `/admin/order/${uuid}`;

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
  {
    path: PRODUCT_DETAILS_ROUTE,
    name: "adminProductDetails",
    component: ProductDetails,
  },
  {
    path: ORDERS_ROUTE,
    name: "adminOrdersView",
    component: OrdersView,
  },
  {
    path: ORDER_DETAILS_ROUTE,
    name: "adminOrderDetails",
    component: OrderDetails,
  },
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
