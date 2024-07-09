<template>
  <div class="flex justify-end items-center p-4">
    <div class="flex items-center">
      <span>Rows per page:</span>
      <Dropdown
        :options="rowsOptions"
        v-model="rowsPerPage"
        @change="onRowsPerPageChange"
        class="ml-2 mr-[48px] border-appGrey border-[1px]"
      ></Dropdown>
    </div>
    <div class="flex items-center">
      <span>{{ paginationText }}</span>
      <Button
        icon="pi pi-angle-left"
        class="p-button-text ml-2"
        @click="previousPage"
        :disabled="!hasPreviousPage"
      ></Button>
      <Button
        icon="pi pi-angle-right"
        class="p-button-text ml-2"
        @click="nextPage"
        :disabled="!hasNextPage"
      ></Button>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed } from "vue";
import { useOrderStore } from "@/composables/useOrderStore";
import Dropdown from "primevue/dropdown";
import Button from "primevue/button";

export default defineComponent({
  name: "TableControls",
  components: { Dropdown, Button },
  setup() {
    const orderStore = useOrderStore();
    const rowsPerPage = computed(() => orderStore.rowsPerPage);
    const totalRecords = computed(() => orderStore.totalRecords);
    const currentPage = computed(() => orderStore.currentPage);

    const rowsOptions = [4, 8, 12, 16];

    const paginationText = computed(() => {
      const start = (currentPage.value - 1) * rowsPerPage.value + 1;
      const end = Math.min(
        currentPage.value * rowsPerPage.value,
        totalRecords.value
      );
      return `${start}-${end} of ${totalRecords.value}`;
    });

    const hasPreviousPage = computed(() => currentPage.value > 1);
    const hasNextPage = computed(
      () => currentPage.value * rowsPerPage.value < totalRecords.value
    );

    const onRowsPerPageChange = (event: any) => {
      const rows = event.value;
      orderStore.setRowsPerPage(rows);
    };

    const previousPage = () => {
      if (hasPreviousPage.value) {
        orderStore.setPage(currentPage.value - 1);
      }
    };

    const nextPage = () => {
      if (hasNextPage.value) {
        orderStore.setPage(currentPage.value + 1);
      }
    };

    return {
      rowsPerPage,
      rowsOptions,
      paginationText,
      hasPreviousPage,
      hasNextPage,
      onRowsPerPageChange,
      previousPage,
      nextPage,
    };
  },
});
</script>

<style scoped>
span {
  margin-right: 0.5rem;
}
</style>
