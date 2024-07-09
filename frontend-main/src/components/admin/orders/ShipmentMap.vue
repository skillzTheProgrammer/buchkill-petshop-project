<template>
  <div
    class="mt-[20px] rounded-lg"
    style="overflow: hidden; max-width: 100%; width: 100%; height: 300px"
  >
    <div id="my-map-display" style="height: 100%; width: 100%; max-width: 100%">
      <iframe
        style="height: 100%; width: 100%; border: 0"
        frameborder="0"
        src="https://www.google.com/maps/embed/v1/place?q=statue+of+liberty&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
      ></iframe>
    </div>
    <a
      class="my-codefor-googlemap"
      href="https://www.bootstrapskins.com/themes"
      id="enable-map-info"
      >premium bootstrap themes</a
    >
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "ShipmentMap",
});
</script>

<style>
#my-map-display img {
  max-height: none;
  max-width: none !important;
  background: none !important;
}
</style>
