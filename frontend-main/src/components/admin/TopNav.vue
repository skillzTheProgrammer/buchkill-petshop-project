<template>
  <div class="flex items-center justify-between p-4 bg-white shadow max-h-[100px]">
    <div class="text-2xl font-bold">
      <p class="text-left">{{ title }}</p>
      <p class="text-appBlue text-xs text-left font-thin">
        Dashboard <span class="text-footerText">{{ route.path }}</span>
      </p>
    </div>
    <!-- Add child here -->
    <div>
      <slot></slot>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { useAuthStore } from "@/composables/useAuthStore";
import { useRoute } from "vue-router";

export default defineComponent({
  props: {
    title: { default: "Dashboard", type: String },
  },
  setup() {
    const route = useRoute();
    const authStore = useAuthStore();

    const logout = () => {
      authStore.logout();
    };

    return { logout, route };
  },
});
</script>
