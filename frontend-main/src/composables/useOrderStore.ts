import { defineStore } from "pinia";
import http from "@/server/config";

interface OrderState {
  orders: any[];
  totalRecords: number;
  loading: boolean;
  rowsPerPage: number;
  currentPage: number;
}

export const useOrderStore = defineStore("orderStore", {
  state: (): OrderState => ({
    orders: [],
    totalRecords: 0,
    loading: false,
    rowsPerPage: 4,
    currentPage: 1,
  }),
  actions: {
    async fetchOrders() {
      this.loading = true;
      try {
        const response: any = await http.get("/orders", {
          params: {
            page: this.currentPage,
            limit: this.rowsPerPage,
          },
        });
        this.orders = response.data;
        this.totalRecords = response.total;
      } catch (error) {
        console.error("Error fetching orders:", error);
      } finally {
        this.loading = false;
      }
    },
    setRowsPerPage(rows: number) {
      this.rowsPerPage = rows;
      this.fetchOrders();
    },
    setPage(page: number) {
      this.currentPage = page;
      this.fetchOrders();
    },
  },
});
