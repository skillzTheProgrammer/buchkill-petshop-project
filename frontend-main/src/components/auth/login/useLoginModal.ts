import { useAuthStore } from "@/composables/useAuthStore";
import { ref, computed } from "vue";
import { formBox, modalWrapper } from "../styles";
import http from "@/server/config";
import { LOGIN_ADMIN } from "@/server/endpoints";

export function useLoginModal() {
  const email = ref("");
  const password = ref("");
  const rememberMe = ref(false);
  const loading = ref(false);
  const authStore = useAuthStore();
  const show = computed(() => authStore.showLoginModal);

  const showSignup = () => {
    authStore.showSignup();
  };

  const login = async () => {
    try {
      loading.value = true;
      const credentials = { email: email.value, password: password.value };
      const response = await http.post(LOGIN_ADMIN, credentials);
      const token: string = response.data.token;
      await authStore.storeToken(token);
      window.location.reload();
      authStore.hideLogin();
    } catch (err: any) {
      alert(err.error);
    } finally {
      loading.value = true;
    }
  };

  return {
    email,
    password,
    rememberMe,
    login,
    show,
    loading,
    authStore,
    showSignup,
    modalWrapper,
    formBox,
  };
}
