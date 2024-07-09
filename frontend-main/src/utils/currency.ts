// src/utils/currency.ts
import axios from "axios";

export const fetchExchangeRates = async () => {
  try {
    const response = await axios.get(
      "https://api.exchangerate-api.com/v4/latest/CNY"
    );
    return response.data;
  } catch (error) {
    console.error("Error fetching exchange rates:", error);
    return { rates: { EUR: 1, GBP: 1 } };
  }
};

export const formatCurrency = (amount: number, currency: string) => {
  return new Intl.NumberFormat("en-US", {
    style: "currency",
    currency,
  }).format(amount);
};
