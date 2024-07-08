<template>
  <div
    class="fixed z-40 flex justify-between items-center w-screen h-[80px] pl-[200px] pr-[100px] bg-primary"
  >
    <div class="flex items-center">
      <img class="w-[31px]" src="../../assets/svgs/logo2.svg" />
      <p class="text-white text-xl ml-[13px]">petson.</p>
    </div>
    <!-- Menu Items Area -->
    <div>
      <div class="flex">
        <div v-for="item in menuItems" :key="item.name" class="mr-[52px]">
          <router-link :to="item.path" class="flex items-center">
            <p class="mr-[4px] text-white font-bold">{{ item.name }}</p>
            <img
              v-if="item.hasDropdown"
              src="../../assets/svgs/dropdown.svg"
              alt="dropdown"
            />
          </router-link>
        </div>
      </div>
    </div>
    <!-- ImageArea -->
    <div class="flex text-white">
      <div
        class="flex items-center mr-4 border-white border rounded-[4px] font-bold p-2 pl-4 pr-4 cursor-pointer"
        @click="goToCart"
      >
        <img class="mr-[6px]" src="../../assets/svgs/cart.svg" alt="cart" />
        <p>CART (0)</p>
      </div>
      <div
        class="flex items-center border-white border rounded-[4px] font-bold p-2 pl-4 pr-4 cursor-pointer"
        @click="logout"
      >
        <p>LOGOUT</p>
      </div>
      <div class="border border-white ml-4 rounded-full">
        <img class="w-[48px]" src="../../assets/svgs/emptyImage.svg" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/composables/useAuthStore";

export default defineComponent({
  setup() {
    const router = useRouter();
    const authStore = useAuthStore();

    const menuItems = [
      {
        name: "PRODUCTS",
        hasDropdown: true,
        path: "/products",
      },
      {
        name: "PROMOTIONS",
        hasDropdown: false,
        path: "/promotions",
      },
      {
        name: "BLOG",
        hasDropdown: false,
        path: "/blog",
      },
    ];

    const goToCart = () => {
      router.push("/cart");
    };

    const logout = () => {
      authStore.logout();
      authStore.showLogin();
    };

    return {
      menuItems,
      goToCart,
      logout,
    };
  },
});
</script>

<style scoped>
.cursor-pointer {
  cursor: pointer;
}
</style>
