<template>
  <div class="mt-3 w-full border border-[#00000014] rounded-md">
    <div class="flex items-center justify-between px-[32px]">
      <p class="text-sm font-[500]">All Customers</p>
      <div class="flex items-center h-[79px]">
        <button
          class="w-full mr-[22px] text-sm bg-primary font-[600] hover:bg-primaryDark text-white py-2 px-4 rounded"
        >
          + ADD NEW PRODUCT
        </button>
        <button class="pl-[32px] border-l-2 h-full flex items-center text-appGrey">
          <p class="text-sm font-[500]">Filter</p>
          <img class="ml-2 w-[12px]" src="@/assets/svgs/downGrey.svg" alt="down" />
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "TableHead",
  setup() {
    const columns = [
      { label: "First Name", field: "first_name" },
      { label: "Email", field: "email" },
      { label: "Phone", field: "phone_number" },
      { label: "Address", field: "address" },
      { label: "Date Created", field: "created_at" },
      { label: "Marketing Preferences", field: "is_marketing" },
    ];

    return {
      columns,
    };
  },
});
</script>

<style scoped>
.table-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>
