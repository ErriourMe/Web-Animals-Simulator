<script lang="ts" setup>
const props = withDefaults(
  defineProps<{
    text: string;
  }>(),
  {}
);
</script>

<template>
  <div
    class="mb-2 font-sans relative w-full transform overflow-hidden rounded-xl bg-brown-50 px-4 py-3 text-left align-middle transition-all drop-shadow-[0_20px_13px_rgba(215,204,200,0.1)]"
  >
    <div class="flex flex-row items-center justify-between">
      <div class="mr-6">
        <span v-if="props.text" class="block text-brown text-[14px]">
          {{ props.text }}
        </span>
      </div>

      <button
        type="button"
        class="w-8 h-8 text-[12px] bg-brown rounded-full ml-4 shrink-0 hover:bg-brown/90 transition"
        data-dismiss-target="#toast-default"
        aria-label="Close"
      >
        ✕
      </button>
    </div>
  </div>
</template>
