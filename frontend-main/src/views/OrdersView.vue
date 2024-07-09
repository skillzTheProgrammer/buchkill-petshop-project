<template>
  <AdminWrapper>
    <TopNav />
    <ShipmentMap />
    <TableComponent />
  </AdminWrapper>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import AdminWrapper from "@/components/admin/AdminWrapper.vue";
import TopNav from "@/components/admin/TopNav.vue";
import ShipmentMap from "@/components/admin/orders/ShipmentMap.vue";
import TableComponent from "@/components/admin/orders/table/TableComponent.vue";

export default defineComponent({
  name: "OrdersView",
  components: {
    AdminWrapper,
    TopNav,
    ShipmentMap,
    TableComponent,
  },
});
</script>
