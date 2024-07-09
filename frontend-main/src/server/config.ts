import axios, {
  AxiosError,
  AxiosInstance,
  AxiosResponse,
  InternalAxiosRequestConfig,
} from "axios";
import { useAuthStore } from "@/composables/useAuthStore";
import { TOKEN_ID } from "@/constant";

export const SERVER_URL = "https://pet-shop.buckhill.com.hr/api/v1" as string;

// Create an Axios instance with base configuration
const http: AxiosInstance = axios.create({
  baseURL: SERVER_URL,
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

// Add a response interceptor to handle errors and show login modal if unauthorized
http.interceptors.response.use(
  (response: AxiosResponse) => {
    return response.data;
  },
  (error: AxiosError) => {
    const authStore = useAuthStore();
    if (error.response?.status === 401) {
      authStore.showLogin(); // Show login modal... refresh token??
    }
    return Promise.reject(error.response?.data);
  }
);

export default http;
