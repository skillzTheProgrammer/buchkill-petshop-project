<template>
  <div>
    <iframe
      class="mt-[20px] rounded-lg"
      src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7761.448284994916!2d6.912673320878558!3d4.890372567980068!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sng!4v1720524894768!5m2!1sen!2sng"
      width="100%"
      height="300"
      style="border: 0"
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
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
