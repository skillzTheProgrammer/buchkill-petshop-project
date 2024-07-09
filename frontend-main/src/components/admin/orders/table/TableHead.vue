<template>
  <div class="mt-3 w-full border border-[#00000014] rounded-md">
    <div class="flex items-center justify-between px-[32px]">
      <p class="text-sm font-[500]">Sales</p>
      <div class="flex items-center">
        <div class="flex items-center space-x-2">
          <input
            v-model="customerName"
            @input="onCustomerNameInput"
            placeholder="Filter by Customer Name"
            class="border rounded px-2 py-1"
          />
          <input
            v-model="customerUuid"
            @input="onCustomerUuidInput"
            placeholder="Filter by Order UUID"
            class="border rounded px-2 py-1"
          />
          <DateRangePicker />
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import DateRangePicker from "@/components/admin/home/DateRangePicker.vue";

export default defineComponent({
  name: "TableHead",
  components: {
    DateRangePicker,
  },
  setup(_, { emit }) {
    const customerName = ref("");
    const customerUuid = ref("");

    const onCustomerNameInput = () => {
      emit("filter", { customerName: customerName.value, customerUuid: "" });
    };

    const onCustomerUuidInput = () => {
      emit("filter", { customerName: "", customerUuid: customerUuid.value });
    };

    return {
      customerName,
      customerUuid,
      onCustomerNameInput,
      onCustomerUuidInput,
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
