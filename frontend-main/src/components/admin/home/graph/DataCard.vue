<template>
  <div class="border border-gray-300 rounded-lg p-4 bg-white shadow-md">
    <div class="flex justify-between items-center mb-2">
      <p class="text-2xl font-bold text-gray-800">{{ formattedAmount }}</p>
      <img :src="logo" alt="Logo" class="w-6 h-6" />
    </div>
    <p class="text-gray-600 text-left">{{ title }}</p>
    <div class="relative mt-4 h-[2px] bg-green-100 rounded">
      <div
        class="absolute top-0 left-0 h-full bg-green-500 rounded"
        :style="{ width: filledBarWidth }"
      ></div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed } from "vue";

export default defineComponent({
  name: "DataCard",
  props: {
    amount: {
      type: Number,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
    logo: {
      type: String,
      required: true,
    },
  },
  setup(props) {
    const filledBarWidth = computed(() => {
      const percentage = Math.min((props.amount / 100) * 100, 100);
      return `${percentage}%`;
    });

    const formattedAmount = computed(() => {
      return `$ ${props.amount.toFixed(3)}`;
    });

    return { filledBarWidth, formattedAmount };
  },
});
</script>
