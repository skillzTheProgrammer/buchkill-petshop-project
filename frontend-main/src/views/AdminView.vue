<template>
  <AdminWrapper>
    <TopNav>
      <DateRangePicker />
    </TopNav>
    <GraphContainer />
  </AdminWrapper>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import TopNav from "@/components/admin/TopNav.vue";
import AdminWrapper from "@/components/admin/AdminWrapper.vue";
import GraphContainer from "@/components/admin/home/graph/GraphContainer.vue";
import DateRangePicker from "@/components/admin/home/DateRangePicker.vue";

export default defineComponent({
  components: {
    AdminWrapper,
    TopNav,
    DateRangePicker,
    GraphContainer,
  },
});
</script>
