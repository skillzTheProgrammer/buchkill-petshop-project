<template>
  <TableHead @filter="onFilter" />
  <div class="pt-4 pb-20">
    <TableData :filters="filters" />
    <div class="relative">
      <TableControls />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, reactive, onMounted } from "vue";
import TableHead from "./TableHead.vue";
import TableData from "./TableData.vue";
import TableControls from "./TableControls.vue";
import { useOrderStore } from "@/composables/useOrderStore";

export default defineComponent({
  name: "TableComponent",
  components: { TableData, TableControls, TableHead },
  setup() {
    const orderStore = useOrderStore();
    onMounted(() => {
      orderStore.fetchOrders();
    });

    const filters = reactive({
      customerName: "",
      customerUuid: "",
    });

    const onFilter = (newFilters: {
      customerName: string;
      customerUuid: string;
    }) => {
      filters.customerName = newFilters.customerName;
      filters.customerUuid = newFilters.customerUuid;
    };

    return {
      filters,
      orders: orderStore.orders,
      loading: orderStore.loading,
      onFilter,
    };
  },
});
</script>
