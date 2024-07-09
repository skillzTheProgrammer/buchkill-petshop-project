// src/composables/useExchangeRates.ts
import { ref } from "vue";
import { fetchExchangeRates } from "@/utils/currency";

export function useExchangeRates() {
  const rates = ref<{ [key: string]: number }>({ EUR: 1, GBP: 1 });

  const fetchRates = async () => {
    const data = await fetchExchangeRates();
    rates.value = data.rates;
  };

  return {
    rates,
    fetchRates,
  };
}
