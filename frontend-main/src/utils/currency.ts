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
  const options: Intl.NumberFormatOptions = {
    style: "currency",
    currency,
  };

  switch (currency) {
    case "EUR":
      return new Intl.NumberFormat("de-DE", options).format(amount);
    case "GBP":
      return new Intl.NumberFormat("en-GB", options).format(amount);
    default:
      return new Intl.NumberFormat("zh-CN", options).format(amount);
  }
};
