import { defineStore } from "pinia";
import http from "@/server/config";
import { getSingleOrder } from "@/server/endpoints";

interface Address {
  billing: string;
  shipping: string;
}

interface OrderStatus {
  uuid: string;
  title: string;
  created_at: string;
  updated_at: string;
}

interface Payment {
  uuid: string;
  type: string;
  details: {
    address: string;
    first_name: string;
    last_name: string;
  };
  created_at: string;
  updated_at: string;
}

interface Product {
  uuid: string;
  product: string;
  price: number;
  quantity: number;
  // Add other relevant fields, but image is removed if not applicable
}

interface User {
  uuid: string;
  first_name: string;
  last_name: string;
  email: string;
  phone_number: string;
  address: string;
  avatar: string;
  created_at: string;
  updated_at: string;
  email_verified_at: string;
  last_login_at: string;
  is_marketing: number;
}

interface Order {
  uuid: string;
  address: Address;
  amount: number;
  created_at: string;
  delivery_fee: number;
  order_status: OrderStatus[];
  payment: Payment;
  products: Product[];
  shipped_at: string | null;
  updated_at: string;
  user: User;
}

interface OrderDetailsState {
  order: Order | null;
  loading: boolean;
}

export const useOrderDetails = defineStore("orderDetails", {
  state: (): OrderDetailsState => ({
    order: null,
    loading: false,
  }),
  actions: {
    async fetchOrder(uuid: string) {
      const endpoint = getSingleOrder(uuid);
      this.loading = true;
      try {
        const response = await http.get(endpoint);
        this.order = response.data;
      } catch (error) {
        console.error("Error fetching order details:", error);
      } finally {
        this.loading = false;
      }
    },
  },
});
