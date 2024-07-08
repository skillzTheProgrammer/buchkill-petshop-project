<template>
  <AdminWrapper>
    <TopNav />
  </AdminWrapper>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import AdminWrapper from "@/components/admin/AdminWrapper.vue";
import TopNav from "@/components/admin/TopNav.vue";
const num = 0;
export default defineComponent({
  components: {
    AdminWrapper,
    TopNav,
  },

  setup() {
    return {
      num,
    };
  },
});
</script>
