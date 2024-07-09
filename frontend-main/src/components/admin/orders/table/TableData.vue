<template>
  <DataTable :value="filteredOrders" :loading="loading" @row-click="navigateToOrder">
    <Column field="uuid" header="Order UUID"></Column>
    <Column header="Order Status" :field="statusField"></Column>
    <Column field="user.first_name" header="Customer"></Column>
    <Column header="Amount" :field="amountField"></Column>
    <Column header="Created at" :field="formattedCreatedAt"></Column>
  </DataTable>
</template>

<script lang="ts">
import { defineComponent, computed, PropType } from "vue";
import { useOrderStore } from "@/composables/useOrderStore";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { useRouter } from "vue-router";
import { format } from "date-fns";
import { getOrdersDetailsRoute } from "@/router";

export default defineComponent({
  name: "TableData",
  components: { DataTable, Column },
  props: {
    filters: {
      type: Object as PropType<{ customerName: string; customerUuid: string }>,
      required: true,
    },
  },
  setup(props) {
    const orderStore = useOrderStore();
    const orders = computed(() => orderStore.orders);
    const loading = computed(() => orderStore.loading);
    const router = useRouter();

    const navigateToOrder = (event: any) => {
      const uuid = event.data.uuid;
      const orderDetailsUrl = getOrdersDetailsRoute(uuid);
      router.push(orderDetailsUrl);
    };

    const amountField = (rowData: any) => `CNY ${rowData.amount.toFixed(2)}`;

    const statusField = (rowData: any) => rowData.order_status[0].title;
    const formattedCreatedAt = (rowData: any) =>
      format(new Date(rowData.created_at), "MMM dd yyyy");

    const filteredOrders = computed(() => {
      return (
        orders.value?.filter((order) => {
          const matchesName = props.filters.customerName
            ? order.user.first_name
                .toLowerCase()
                .includes(props.filters.customerName.toLowerCase())
            : true;
          const matchesUuid = props.filters.customerUuid
            ? order.uuid
                .toLowerCase()
                .includes(props.filters.customerUuid.toLowerCase())
            : true;
          return matchesName && matchesUuid;
        }) || []
      );
    });
    return {
      orders,
      loading,
      navigateToOrder,
      amountField,
      formattedCreatedAt,
      statusField,
      filteredOrders,
    };
  },
});
</script>

<style scoped>
th,
td {
  padding: 1rem;
  border-bottom: 1px solid grey;
}
</style>
