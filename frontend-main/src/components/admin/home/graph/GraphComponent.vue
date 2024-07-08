<template>
  <div class="chart-container">
    <GChart
      type="LineChart"
      :data="chartData"
      :options="chartOptions"
      class="line-chart"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { GChart } from "vue-google-charts";

export default defineComponent({
  name: "MonthlySalesChart",
  components: {
    GChart,
  },
  data() {
    return {
      chartData: [
        ["Day", "Sales"],
        ["1.7", 100],
        ["2.7", 90],
        ["3.7", 80],
        ["4.7", 90],
        ["5.7", 85],
        ["6.7", 95],
        ["7.7", 75],
        ["8.7", 85],
        ["9.7", 70],
        ["10.7", 80],
        ["11.7", 85],
        ["12.7", 60],
        ["13.7", 70],
        ["14.7", 90],
        ["15.7", 95],
        ["16.7", 85],
        ["17.7", 100],
        ["18.7", 90],
        ["19.7", 75],
        ["20.7", 85],
        ["21.7", 70],
        ["22.7", 80],
        ["23.7", 85],
        ["24.7", 60],
        ["25.7", 70],
        ["26.7", 80],
        ["27.7", 75],
        ["28.7", 85],
        ["29.7", 90],
        ["30.7", 100],
      ],
      chartOptions: {
        title: "Monthly sales",
        curveType: "function",
        legend: { position: "none" },
        pointSize: 5,
        hAxis: {
          title: "",
          textStyle: {
            fontSize: 11, // Change this to your desired font size
          },
          gridlines: {
            count: 10,
          },
        },
        vAxis: {
          title: "",
          viewWindow: {
            min: 20,
            max: 100,
          },
          textStyle: {
            fontSize: 11,
          },
        },
        series: {
          0: { color: "#4ec690" },
        },
        chartArea: {
          width: "90%",
          height: "70%",
        },
        titleTextStyle: {
          fontSize: 12,
        },
      },
    };
  },
});
</script>

<style scoped>
.chart-container {
  width: 100%;
  overflow: hidden;
  padding: 10px;
  background-color: #f9fafb;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.line-chart {
  width: 100%;
  height: 299px;
}
</style>
