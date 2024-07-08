import { defineStore } from "pinia";

interface DateRangeState {
  startDate: Date | null;
  endDate: Date | null;
}

export const useDateRangeStore = defineStore("dateRange", {
  state: (): DateRangeState => ({
    startDate: null,
    endDate: null,
  }),
  actions: {
    setDateRange(startDate: Date, endDate: Date) {
      this.startDate = startDate;
      this.endDate = endDate;
    },
    clearDateRange() {
      this.startDate = null;
      this.endDate = null;
    },
  },
});
