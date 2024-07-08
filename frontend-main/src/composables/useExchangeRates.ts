import { ref } from "vue";
import axios from "axios";

//this should ideally be in an env file
const API_KEY = "d40f76598ab06a71eedb5fe1a3d64af5";

export function useExchangeRates() {
  const rates = ref<{ [key: string]: number }>({});
  const loading = ref(false);
  const error: any = ref(null);

  const fetchExchangeRates = async () => {
    loading.value = true;
    error.value = null;
    try {
      const response = await axios.get(
        `http://api.exchangeratesapi.io/latest?base=CNY&access_key=${API_KEY}`
      );
      rates.value = response.data.rates;
      console.log("Fetched exchange rates:", rates.value); // Debugging line
    } catch (err) {
      error.value = err;
      console.error("Error fetching exchange rates:", err); // Debugging line
    } finally {
      loading.value = false;
    }
  };

  return {
    rates,
    loading,
    error,
    fetchExchangeRates,
  };
}
