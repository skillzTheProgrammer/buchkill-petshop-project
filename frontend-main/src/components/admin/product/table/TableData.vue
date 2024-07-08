<template>
  <DataTable :value="products" :loading="loading" @row-click="navigateToProduct">
    <Column header="Image">
      <template #body="slotProps">
        <img
          :src="`https://pet-shop.buckhill.com.hr/api/v1/file/${slotProps.data.metadata.image}`"
          :alt="slotProps.data.metadata.image"
          class="w-24 rounded"
        />
      </template>
    </Column>
    <Column field="title" header="Name"></Column>
    <Column field="brand.title" header="Brand"></Column>
    <Column field="category.title" header="Category"></Column>
    <Column field="created_at" header="Date Created"></Column>
  </DataTable>
</template>

<script lang="ts">
import { defineComponent, computed } from "vue";
import { useProductStore } from "@/composables/useProductStore";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { useRouter } from "vue-router";
import { getProductDetailsRoute } from "@/router";

export default defineComponent({
  name: "TableData",
  components: { DataTable, Column },
  setup() {
    const productStore = useProductStore();
    const products = computed(() => productStore.products);
    const loading = computed(() => productStore.loading);
    const router = useRouter();

    const navigateToProduct = (event: any) => {
      console.log({event})
      const uuid = event.data.uuid;
      const productDetailsURL = getProductDetailsRoute(uuid);
      router.push(productDetailsURL);
    };

    return {
      products,
      loading,
      navigateToProduct,
    };
  },
});
</script>

<style scoped>
th,
td {
  padding: 1rem;
  border-bottom: 1px solid grey;
}
</style>
