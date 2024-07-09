import http from "@/server/config";
import { PRODUCT_ENDPOINT } from "@/server/endpoints";
import { defineStore } from "pinia";

interface Product {
  uuid: string;
  image: string;
  title: string;
  brand: { title: string };
  category: { title: string };
  created_at: string;
}

interface ProductState {
  products: Product[];
  totalRecords: number;
  loading: boolean;
  rowsPerPage: number;
  currentPage: number;
}

export const useProductStore = defineStore("productStore", {
  state: (): ProductState => ({
    products: [],
    totalRecords: 0,
    loading: false,
    rowsPerPage: 4,
    currentPage: 1,
  }),
  actions: {
    async fetchProducts() {
      this.loading = true;
      try {
        const response: any = await http.get(PRODUCT_ENDPOINT, {
          params: {
            page: this.currentPage,
            limit: this.rowsPerPage,
          },
        });
        this.products = response.data;
        this.totalRecords = response.total;
      } catch (error) {
        console.error("Error fetching products:", error);
      } finally {
        this.loading = false;
      }
    },
    setRowsPerPage(rows: number) {
      this.rowsPerPage = rows;
      this.fetchProducts();
    },
    setPage(page: number) {
      this.currentPage = page;
      this.fetchProducts();
    },
  },
});
