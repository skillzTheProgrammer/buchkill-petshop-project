<template>
  <AdminWrapper>
    <TopNav />
    <h1 v-if="loading">Loading</h1>
    <div v-else class="p-4 bg-white shadow rounded">
      <div class="flex items-center mb-4">
        <img :src="productImageUrl" alt="Product Image" class="w-32 h-32 mr-4" />
        <div>
          <h1 class="text-2xl font-bold">{{ product?.title }}</h1>
          <p class="text-gray-600">{{ product?.category?.title }}</p>
        </div>
      </div>
      <div>
        <label for="currency" class="block text-sm font-medium text-gray-700"
          >Currency</label
        >
        <select
          id="currency"
          v-model="selectedCurrency"
          class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
        >
          <option value="CNY">CNY</option>
          <option value="EUR">EUR</option>
          <option value="GBP">GBP</option>
        </select>
      </div>
      <div class="mt-4">
        <h2 class="text-xl font-semibold">Details</h2>
        <p class="mb-2"><strong>Brand:</strong> {{ product?.brand?.title }}</p>
        <p class="mb-2"><strong>Description:</strong> {{ product?.description }}</p>
        <p class="mb-2"><strong>Price:</strong> {{ formattedPrice }}</p>
        <p class="mb-2">
          <strong>Original Price (CNY):</strong> {{ product?.price }}
        </p>
      </div>
    </div>
  </AdminWrapper>
</template>

<script lang="ts">
import { defineComponent, computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import AdminWrapper from "@/components/admin/AdminWrapper.vue";
import { useProductDetails } from "@/composables/useProductDetails";
import { useExchangeRates } from "@/composables/useExchangeRates";
import { SERVER_URL } from "@/server/config";
import TopNav from "@/components/admin/TopNav.vue";

export default defineComponent({
  name: "ProductDetails",
  components: {
    AdminWrapper,
    TopNav,
  },
  setup() {
    const route = useRoute();
    const { product, loading, fetchProduct } = useProductDetails();
    const { rates, fetchExchangeRates } = useExchangeRates();
    const selectedCurrency = ref("CNY");

    const productImageUrl = computed(() => {
      return product.value?.metadata?.image
        ? `${SERVER_URL}/file/${product.value.metadata.image}`
        : "";
    });

    const formattedPrice = computed(() => {
      if (!product.value || !product.value.price) return "N/A";
      const priceInCNY = product.value.price;
      let convertedPrice = priceInCNY;

      if (selectedCurrency.value === "EUR" && rates.value["EUR"]) {
        convertedPrice = priceInCNY * rates.value["EUR"];
        return new Intl.NumberFormat("de-DE", {
          style: "currency",
          currency: "EUR",
        }).format(convertedPrice);
      } else if (selectedCurrency.value === "GBP" && rates.value["GBP"]) {
        convertedPrice = priceInCNY * rates.value["GBP"];
        return new Intl.NumberFormat("en-GB", {
          style: "currency",
          currency: "GBP",
        }).format(convertedPrice);
      } else {
        return new Intl.NumberFormat("zh-CN", {
          style: "currency",
          currency: "CNY",
        }).format(convertedPrice);
      }
    });

    onMounted(() => {
      const uuid = route.params.uuid as string;
      fetchProduct(uuid);
      fetchExchangeRates();
    });

    return {
      product,
      loading,
      productImageUrl,
      selectedCurrency,
      formattedPrice,
    };
  },
});
</script>

<style scoped>
/* Add any additional styles if necessary */
</style>
