<template>
  <AppNav />
  <div class="flex h-screen">
    <SideMenu />
    <div class="flex-1 flex flex-col mt-[80px] px-5">
      <TopNav>
        <DateRangePicker />
      </TopNav>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import SideMenu from "@/components/admin/SideMenu.vue";
import TopNav from "@/components/admin/TopNav.vue";
import AppNav from "@/components/admin/AppNav.vue";
import DateRangePicker from "@/components/admin/home/DateRangePicker.vue";

export default defineComponent({
  components: {
    SideMenu,
    TopNav,
    AppNav,
    DateRangePicker,
  },
});
</script>
