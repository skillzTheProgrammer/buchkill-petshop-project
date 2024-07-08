<template>
  <div class="bg-[#EDF5F1]">
    <GraphComponent />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 pl-2 pr-2">
      <DataCard :amount="2405" title="Total Earnings" :logo="greenDollar" />
      <DataCard :amount="30" title="Orders this Month" :logo="greenCart" />
      <DataCard :amount="1224" title="Potential Earnings" :logo="greenDollar" />
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import GraphComponent from "./GraphComponent.vue";
import DataCard from "./DataCard.vue";
import greenDollar from "@/assets/svgs/greenDollar.svg";
import greenCart from "@/assets/svgs/greenCart.svg";

export default defineComponent({
  components: {
    GraphComponent,
    DataCard,
  },

  setup() {
    return {
      greenCart,
      greenDollar,
    };
  },
});
</script>
