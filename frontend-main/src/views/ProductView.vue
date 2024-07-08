<template>
  <AdminWrapper>
    <TopNav />
    <TableComponent />
  </AdminWrapper>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import AdminWrapper from "@/components/admin/AdminWrapper.vue";
import TopNav from "@/components/admin/TopNav.vue";
import TableComponent from "@/components/admin/product/table/TableComponent.vue";
const num = 0;
export default defineComponent({
  components: {
    AdminWrapper,
    TopNav,
    TableComponent,
  },

  setup() {
    return {
      num,
    };
  },
});
</script>
