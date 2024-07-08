<script lang="ts">
import { defineComponent } from "vue";
import { useLoginModal } from "./useLoginModal";

export default defineComponent({
  setup() {
    return useLoginModal();
  },
});
</script>

<template>
  <div v-if="show" :class="modalWrapper">
    <div class="relative bg-white rounded-lg p-12 w-full max-w-md shadow-lg">
      <!-- Close button -->
      <button
        @click="authStore.hideLogin"
        class="absolute top-3 right-3 text-footerText hover:text-gray-800"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </button>
      <!-- Logo -->
      <div class="flex justify-center mb-4">
        <img src="@/assets/svgs/logo.svg" alt="Logo" class="h-16 w-16" />
      </div>
      <!-- Header -->
      <h2 class="text-2xl font-bold mb-4 text-center">Logins</h2>
      <!-- Form -->
      <form @submit.prevent="login">
        <div class="mb-4">
          <input
            type="email"
            placeholder="Email*"
            v-model="email"
            id="email"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary"
            required
          />
        </div>
        <div class="mb-4">
          <input
            type="password"
            placeholder="Password*"
            v-model="password"
            id="password"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary"
            required
          />
        </div>
        <div class="mb-6 flex items-center">
          <input
            type="checkbox"
            v-model="rememberMe"
            id="rememberMe"
            class="h-4 w-4 text-primary focus:ring-green-500 border-footerText rounded border-2"
          />
          <label for="rememberMe" class="ml-2 block text-sm text-gray-900"
            >Remember me</label
          >
        </div>
        <div class="flex justify-end mb-6">
          <button
            type="submit"
            class="w-full bg-primary hover:bg-primaryDark text-white py-2 px-4 rounded hover:bg-primary-dark"
          >
            <span v-if="loading">loading...</span>
            <span v-else>LOG IN</span>
          </button>
        </div>
      </form>
      <div class="flex justify-between text-sm text-appBlue">
        <a href="#" class="hover:underline">Forgot password?</a>
        <a href="#" class="hover:underline" @click="showSignup"
          >Don't have an account? Signup</a
        >
      </div>
    </div>
  </div>
</template>
