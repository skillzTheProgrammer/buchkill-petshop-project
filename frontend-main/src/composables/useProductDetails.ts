import { ref } from "vue";
import http from "@/server/config";
import { getSingleProduct } from "@/server/endpoints";

export interface Product {
  uuid: string;
  title: string;
  description: string;
  price: number;
  metadata: {
    image: string;
  };
  brand: {
    title: string;
  };
  category: {
    title: string;
  };
}

export function useProductDetails() {
  const product = ref<Product | null>(null);
  const loading = ref(false);

  const fetchProduct = async (uuid: string) => {
    const endpoint = getSingleProduct(uuid);
    loading.value = true;
    try {
      const response = await http.get(endpoint);
      product.value = response.data;
      console.log({ response, product });
    } catch (error) {
      console.error("Error fetching product details:", error);
    } finally {
      loading.value = false;
    }
  };

  return {
    product,
    loading,
    fetchProduct,
  };
}
