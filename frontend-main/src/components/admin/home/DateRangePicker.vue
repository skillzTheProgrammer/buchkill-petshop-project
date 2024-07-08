<template>
  <div class="pt-2 bg-white">
    <div class="flex items-center space-x-4 mb-4">
      <div class="relative">
        <DatePicker
          v-model="dateRange"
          range
          placeholder="Date range"
          :start-placeholder="startPlaceholder"
          :end-placeholder="endPlaceholder"
          input-class-name="['input']"
          class="border rounded p-2 custom-datepicker"
        />
      </div>
      <div class="flex space-x-2">
        <button
          :class="[
            'w-[72px] rounded-[16px] h-[32px] text-[13px]',
            activeRange === 'today'
              ? 'bg-primary text-white'
              : 'bg-[#DDE3E2] text-black',
          ]"
          @click="setToday"
        >
          Today
        </button>
        <button
          :class="[
            'w-[72px] rounded-[16px] h-[32px] text-[13px]',
            activeRange === 'lastWeek'
              ? 'bg-primary text-white'
              : 'bg-[#DDE3E2] text-black',
          ]"
          @click="setLastWeek"
        >
          Monthly
        </button>
        <button
          :class="[
            'w-[72px] rounded-[16px] h-[32px] text-[13px]',
            activeRange === 'lastMonth'
              ? 'bg-primary text-white'
              : 'bg-[#DDE3E2] text-black',
          ]"
          @click="setLastMonth"
        >
          Yearly
        </button>
      </div>
    </div>
    <div
      v-if="dateRange && dateRange.length === 2"
      class="text-gray-600 text-[13px]"
    >
      Selected Range: {{ formattedDateRange }}
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed, ref } from "vue";
import { useDateRangeStore } from "@/composables/useDateRange";
import DatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default defineComponent({
  components: {
    DatePicker,
  },
  setup() {
    const dateRangeStore = useDateRangeStore();
    const dateRange = ref<[Date, Date] | null>(
      dateRangeStore.startDate && dateRangeStore.endDate
        ? [dateRangeStore.startDate, dateRangeStore.endDate]
        : null
    );

    const formatter = (date: Date) => {
      return date.toLocaleDateString("en-GB", {
        day: "2-digit",
        month: "short",
        year: "numeric",
      });
    };

    const rangeFormatter = (range: [Date, Date] | Date | null) => {
      if (Array.isArray(range)) {
        return `${formatter(range[0])} - ${formatter(range[1])}`;
      }
      return "";
    };

    const startPlaceholder = "Start Date";
    const endPlaceholder = "End Date";

    const formattedDateRange = computed(() => {
      if (dateRange.value && dateRange.value.length === 2) {
        return rangeFormatter(dateRange.value);
      }
      return "";
    });

    const today = new Date();
    const todayRange: [Date, Date] = [today, today];
    const setToday = () => {
      dateRangeStore.setDateRange(today, today);
      dateRange.value = [today, today];
    };

    const lastWeekRange = computed(() => {
      const endDate = new Date();
      const startDate = new Date();
      startDate.setDate(endDate.getDate() - 7);
      return [startDate, endDate];
    });

    const setLastWeek = () => {
      const [startDate, endDate] = lastWeekRange.value;
      dateRangeStore.setDateRange(startDate, endDate);
      dateRange.value = [startDate, endDate];
    };

    const lastMonthRange = computed(() => {
      const endDate = new Date();
      const startDate = new Date();
      startDate.setMonth(endDate.getMonth() - 1);
      return [startDate, endDate];
    });

    const setLastMonth = () => {
      const [startDate, endDate] = lastMonthRange.value;
      dateRangeStore.setDateRange(startDate, endDate);
      dateRange.value = [startDate, endDate];
    };

    const clearDateRange = () => {
      dateRangeStore.clearDateRange();
      dateRange.value = null;
    };

    const activeRange = computed(() => {
      if (!dateRange.value) {
        return null;
      }
      if (
        dateRange.value[0].toDateString() === today.toDateString() &&
        dateRange.value[1].toDateString() === today.toDateString()
      ) {
        return "today";
      }
      if (
        dateRange.value[0].toDateString() ===
          lastWeekRange.value[0].toDateString() &&
        dateRange.value[1].toDateString() === lastWeekRange.value[1].toDateString()
      ) {
        return "lastWeek";
      }
      if (
        dateRange.value[0].toDateString() ===
          lastMonthRange.value[0].toDateString() &&
        dateRange.value[1].toDateString() === lastMonthRange.value[1].toDateString()
      ) {
        return "lastMonth";
      }
      return null;
    });

    return {
      dateRange,
      rangeFormatter,
      startPlaceholder,
      endPlaceholder,
      formattedDateRange,
      setToday,
      setLastWeek,
      setLastMonth,
      clearDateRange,
      activeRange,
      todayRange,
      lastWeekRange,
      lastMonthRange,
    };
  },
});
</script>

<style>
.dp__range_end,
.dp__range_start,
.dp__active_date {
  background-color: #0baf74;
  border: none;
  border-radius: 50%;
}

.dp__range_between {
  border-radius: 50%;
  color: #0baf74;
}

.dp__today {
  border: 1px solid #0baf74;
  border-radius: 50%;
}

.dp__calendar {
  font-size: 14px;
  font-weight: 500;
}

.dp__date_hover:hover {
  border-radius: 50%;
}

.dp__action_buttons .dp__action_select:hover {
  background-color: #0baf74;
}

.dp__action_buttons .dp__action_select {
  padding: 2px 8px;
  background-color: #0baf74;
}

.dp__action_cancel:hover {
  border: 1px solid #0baf74;
}

input:where(:not([type])):focus {
  border-color: #0baf74 !important;
}
</style>
