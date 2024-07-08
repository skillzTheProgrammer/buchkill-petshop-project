<template>
  <TableHead />
  <div class="pt-4 pb-20">
    <TableData />
    <div class="relative">
      <TableControls />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import TableHead from "./TableHead.vue";
import TableData from "./TableData.vue";
import TableControls from "./TableControls.vue";
import { useProductStore } from "@/composables/useProductStore";

export default defineComponent({
  name: "ProductTable",
  components: { TableData, TableControls, TableHead },
  setup() {
    const productStore = useProductStore();
    onMounted(() => {
      productStore.fetchProducts();
    });
    return {
      products: productStore.products,
      loading: productStore.loading,
    };
  },
});
</script>
