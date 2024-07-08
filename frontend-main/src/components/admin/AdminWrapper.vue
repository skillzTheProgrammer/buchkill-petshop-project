<template>
  <AppNav />
  <div class="fixed">
    <SideMenu />
  </div>
  <div class="flex h-screen ml-64">
    <div class="flex-1 flex flex-col mt-[80px] px-5">
      <slot></slot>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import SideMenu from "@/components/admin/SideMenu.vue";
import AppNav from "@/components/admin/AppNav.vue";

export default defineComponent({
  components: {
    SideMenu,
    AppNav,
  },
});
</script>
