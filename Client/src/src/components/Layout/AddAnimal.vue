<script lang="ts" setup>
import { ref } from "vue";

const isOpen = ref(false);

const invertButton = () => {
  isOpen.value = !isOpen.value;
};
</script>

<template>
  <div class="flex">
    <button
      @click="invertButton"
      class="relative z-2 w-12 h-12 rounded-full bg-brown-500 text-white text-6 flex items-center justify-center transition hover:(bg-brown-400)"
    >
      <span class="mt--1">+</span>
    </button>
    <div
      :class="`relative z-1 bg-brown-50 p-1 rounded-r ml--7 transition-all w-0 ${
        isOpen ? `w-100 pl-11.5` : ``
      }`"
    ></div>
  </div>
</template>
