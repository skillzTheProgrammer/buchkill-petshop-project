import { ref } from "vue";
import axios from "axios";

export function useOrderStore() {
  const orders = ref<any[]>([]);
  const totalRecords = ref(0);
  const loading = ref(false);
  const currentPage = ref(1);
  const rowsPerPage = ref(4);

  const fetchOrders = async (page = 1, limit = 4, sortBy = "", desc = false) => {
    loading.value = true;
    try {
      const response = await axios.get("/api/v1/orders", {
        params: {
          page,
          limit,
          sortBy,
          desc,
        },
      });
      orders.value = response.data.data;
      totalRecords.value = response.data.total;
      currentPage.value = page;
      rowsPerPage.value = limit;
    } catch (error) {
      console.error("Error fetching orders:", error);
    } finally {
      loading.value = false;
    }
  };

  return {
    orders,
    totalRecords,
    loading,
    currentPage,
    rowsPerPage,
    fetchOrders,
  };
}
