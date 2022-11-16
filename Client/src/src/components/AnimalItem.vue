<script lang="ts" setup>
import { ref, watch } from "vue";
import { useDraggable } from "@vueuse/core";

const item = ref<HTMLElement | null>(null);

const position = useDraggable(item, {
  initialValue: { x: 40, y: 40 },
});

const { x, y, style } = position;

watch(position, async (oldVal, newVal) => {});
</script>

<template>
  <div
    class="fixed w-20 h-20 bg-white select-none"
    :style="style"
    ref="item"
  ></div>
</template>
