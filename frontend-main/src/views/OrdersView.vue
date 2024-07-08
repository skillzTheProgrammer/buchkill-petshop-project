<template>
  <AdminWrapper>
    <TopNav />
    <ShipmentMap />
  </AdminWrapper>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import AdminWrapper from "@/components/admin/AdminWrapper.vue";
import TopNav from "@/components/admin/TopNav.vue";
import ShipmentMap from "@/components/admin/orders/ShipmentMap.vue";
const num = 0;
export default defineComponent({
  name: "OrdersView",
  components: {
    AdminWrapper,
    TopNav,
    ShipmentMap,
  },

  setup() {
    return {
      num,
    };
  },
});
</script>
