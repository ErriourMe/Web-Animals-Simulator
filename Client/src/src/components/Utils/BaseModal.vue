<script lang="ts" setup>
import { ref } from 'vue';
import { useEventBus } from '@vueuse/core';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
} from '@headlessui/vue';

const props = withDefaults(
  defineProps<{
    id: string;
    size?: string;
  }>(),
  {
    size: 'xl',
  }
);

const openModalEvent = useEventBus<string>(`modal:${props.id}.open`);
const closeModalEvent = useEventBus<string>(`modal:${props.id}.close`);

const isOpen = ref(false);

const openModal = () => {
  isOpen.value = true;
};

const closeModal = () => {
  isOpen.value = false;
};

openModalEvent.on(() => openModal());
closeModalEvent.on(() => closeModal());
</script>

<template>
  <TransitionRoot :show="isOpen" as="template">
    <Dialog as="div" class="relative z-10" :open="isOpen" @close="closeModal">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div
          class="fixed inset-0 bg-blue-200 bg-opacity-20 backdrop-blur backdrop-saturate-120"
          aria-hidden="true"
        />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="transition duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="transition duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <div :class="`flex relative w-full max-w-${props.size}`">
              <DialogPanel
                class="relative w-full transform overflow-hidden rounded-2xl bg-brown-50 p-6 text-left align-middle drop-shadow-[0_20px_13px_rgba(215,204,200,0.1)] transition-all"
              >
                <slot />
              </DialogPanel>
              <div class="w-0">
                <button
                  class="w-10 h-10 sticky right-0 top-4 bg-brown rounded-full ml-4 shrink-0 text-white hover:bg-brown-400 transition"
                  @click="closeModal"
                >
                  ✕
                </button>
              </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
