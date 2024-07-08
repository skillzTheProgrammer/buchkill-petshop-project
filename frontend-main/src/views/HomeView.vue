<template>
  <div>
    <h1>Counter: {{ count }}</h1>
    <h2>Double Count: {{ doubleCount }}</h2>
    <button @click="increment">Increment</button>
    <button @click="decrement">Decrement</button>
  </div>
</template>

<script setup lang="ts">
import { computed } from "vue";
import { useCounterStore } from "@/composables/useCounter";

const counterStore = useCounterStore();

const count = computed(() => counterStore.count);
const doubleCount = computed(() => counterStore.doubleCount);

const increment = () => counterStore.increment();
const decrement = () => counterStore.decrement();

console.log({ count });
</script>

<style scoped>
button {
  margin: 0 5px;
  padding: 5px 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
