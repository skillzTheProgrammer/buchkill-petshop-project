// src/store/modules/auth.ts
import { defineStore } from "pinia";
import http from "@/server/config";
import { TOKEN_ID } from "@/constant";
import { GET_USER, LOGOUT_ADMIN } from "@/server/endpoints";

interface User {
  email: string;
  firstName: string;
  lastName: string;
  address: string;
  phoneNumber: string;
}

interface AuthState {
  token: string | null;
  user: User | null;
  showLoginModal: boolean;
  showSignupModal: boolean;
}

export const useAuthStore = defineStore("auth", {
  state: (): AuthState => ({
    token: null,
    user: null,
    showLoginModal: false,
    showSignupModal: false,
  }),
  actions: {
    showLogin() {
      this.showLoginModal = true;
      this.showSignupModal = false;
    },
    hideLogin() {
      this.showLoginModal = false;
    },
    showSignup() {
      this.showSignupModal = true;
      this.showLoginModal = false;
    },
    hideSignup() {
      this.showSignupModal = false;
    },
    async storeToken(token: string) {
      localStorage.setItem(TOKEN_ID, token);
      http.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
      await this.fetchUser();
    },
    async fetchUser() {
      if (this.token) {
        const response = await http.get(GET_USER);
        this.user = response.data.data;
      }
    },
    async removeToken() {
      this.token = null;
      this.user = null;
      localStorage.removeItem(TOKEN_ID);
      delete http.defaults.headers.common["Authorization"];
      this.showLogin();
    },
    async logout() {
      try {
        await http.post(LOGOUT_ADMIN);
      } catch (error) {
        console.error("Error logging out:", error);
      } finally {
        this.removeToken();
        window.location.reload(); // Refresh the page upon logout
      }
    },
  },
});
