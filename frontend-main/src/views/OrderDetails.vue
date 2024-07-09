<template>
  <AdminWrapper>
    <TopNav />
    <div v-if="loading" class="p-4">Loading...</div>
    <div v-else class="p-4 bg-white shadow rounded">
      <div class="flex items-center mb-4">
        <div>
          <h1 class="text-2xl font-bold">{{ order?.uuid }}</h1>
          <p class="text-gray-600">{{ order?.order_status[0]?.title }}</p>
        </div>
      </div>
      <div>
        <h2 class="text-xl font-semibold">Details</h2>
        <p class="mb-2">
          <strong>User:</strong> {{ order?.user.first_name }}
          {{ order?.user.last_name }}
        </p>
        <p class="mb-2">
          <strong>Billing Address:</strong> {{ order?.address.billing }}
        </p>
        <p class="mb-2">
          <strong>Shipping Address:</strong> {{ order?.address.shipping }}
        </p>
        <p class="mb-2"><strong>Amount:</strong> {{ formattedPrice }}</p>
        <p class="mb-2"><strong>Order Date:</strong> {{ formattedDate }}</p>
        <p class="mb-2"><strong>Payment Type:</strong> {{ order?.payment?.type }}</p>
        <p class="mb-2"><strong>Delivery Fee:</strong> {{ order?.delivery_fee }}</p>
      </div>
      <div class="mt-4">
        <label for="currency" class="mr-2">Display Price in:</label>
        <select
          v-model="selectedCurrency"
          @change="convertCurrency"
          id="currency"
          class="border rounded px-2 py-1"
        >
          <option value="CNY">Chinese Yuan (CNY)</option>
          <option value="EUR">Euro (EUR)</option>
          <option value="GBP">British Pound (GBP)</option>
        </select>
      </div>
      <div>
        <h2 class="text-xl font-semibold mt-4">Products</h2>
        <ul class="list-disc pl-5">
          <li v-for="product in order?.products" :key="product.uuid">
            {{ product.product }} -
            {{ formatCurrency(product.price, selectedCurrency) }} (Quantity:
            {{ product.quantity }})
          </li>
        </ul>
      </div>
      <button
        @click="downloadPDF"
        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded"
      >
        Download PDF
      </button>
    </div>
  </AdminWrapper>
</template>

<script lang="ts">
import { defineComponent, computed, ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import AdminWrapper from "@/components/admin/AdminWrapper.vue";
import { useOrderDetails } from "@/composables/useOrderDetails";
import { SERVER_URL } from "@/server/config";
import TopNav from "@/components/admin/TopNav.vue";
import { format } from "date-fns";
import jsPDF from "jspdf";
import "jspdf-autotable";
import { fetchExchangeRates, formatCurrency } from "@/utils/currency";

interface ExchangeRates {
  EUR: number;
  GBP: number;
}

export default defineComponent({
  name: "OrderDetails",
  components: {
    AdminWrapper,
    TopNav,
  },
  setup() {
    const route = useRoute();
    const orderDetails = useOrderDetails();
    const order = computed(() => orderDetails.order);
    const loading = computed(() => orderDetails.loading);
    const selectedCurrency = ref("CNY");
    const exchangeRates = ref<ExchangeRates>({ EUR: 1, GBP: 1 });
    const convertedPrice = ref(order.value?.amount || 0);

    const formattedPrice = computed(() => {
      return formatCurrency(convertedPrice.value, selectedCurrency.value);
    });

    const formattedDate = computed(() => {
      if (!order.value?.created_at) {
        return "";
      }
      const date = new Date(order.value.created_at);
      return isNaN(date.getTime()) ? "" : format(date, "MMM dd yyyy");
    });

    onMounted(async () => {
      const uuid = route.params.uuid as string;
      await orderDetails.fetchOrder(uuid);
      const rates = await fetchExchangeRates();
      exchangeRates.value = { EUR: rates.rates.EUR, GBP: rates.rates.GBP };
      convertCurrency();
    });

    const convertCurrency = () => {
      if (!order.value) return;
      if (selectedCurrency.value === "CNY") {
        convertedPrice.value = order.value.amount;
      } else {
        convertedPrice.value =
          order.value.amount * (exchangeRates.value as any)[selectedCurrency.value];
      }
    };

    const downloadPDF = () => {
      if (!order.value) return;
      const doc = new jsPDF();
      doc.text("Order Details", 14, 22);
      doc.autoTable({
        head: [["Field", "Value"]],
        body: [
          ["Order UUID", order.value.uuid],
          ["User", `${order.value.user.first_name} ${order.value.user.last_name}`],
          ["Billing Address", order.value.address.billing],
          ["Shipping Address", order.value.address.shipping],
          ["Amount", formattedPrice.value],
          ["Order Date", formattedDate.value],
          ["Payment Type", order.value.payment?.type],
          ["Delivery Fee", order.value.delivery_fee],
        ],
      });
      const products = order.value.products.map((product) => [
        product.product,
        `Price: ${formatCurrency(
          product.price,
          selectedCurrency.value
        )} (Quantity: ${product.quantity})`,
      ]);
      doc.autoTable({
        head: [["Product", "Details"]],
        body: products,
      });
      doc.save(`Order_${order.value.uuid}.pdf`);
    };

    return {
      order,
      loading,
      selectedCurrency,
      formattedPrice,
      formattedDate,
      downloadPDF,
      convertCurrency,
      formatCurrency, // To format individual product prices
    };
  },
});
</script>

<style scoped>
td {
  padding: 1rem;
}
</style>
