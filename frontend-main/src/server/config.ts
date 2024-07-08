import axios, {
  AxiosError,
  AxiosInstance,
  AxiosResponse,
  InternalAxiosRequestConfig,
} from "axios";
import { useAuthStore } from "@/composables/useAuthStore";
import { TOKEN_ID } from "@/constant";

// Create an Axios instance with base configuration
const http: AxiosInstance = axios.create({
  baseURL: "https://pet-shop.buckhill.com.hr/api/v1",
  headers: {
    "Content-Type": "application/json",
  },
});

// Add a request interceptor to add the authorization token to headers
http.interceptors.request.use(
  (config: InternalAxiosRequestConfig) => {
    const authStore = useAuthStore();
    const token = localStorage.getItem(TOKEN_ID) || authStore.token;
    if (token && config.headers) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error: AxiosError) => {
    return Promise.reject(error);
  }
);

// Add a response interceptor to only return the data
http.interceptors.response.use(
  (response: AxiosResponse) => {
    return response.data;
  },
  (error: AxiosError) => {
    return Promise.reject(error.response?.data);
  }
);

export default http;
