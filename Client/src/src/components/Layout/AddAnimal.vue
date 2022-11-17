<script lang="ts" setup>
import { ref } from 'vue';
import { useEventBus } from '@vueuse/core';
import { useAnimalKinds } from '~/stores/animalKind';
import { useAnimals } from '~/stores/animal';
import AddAnimalModal from '~/components/Modals/AddAnimalModal.vue';
import type { IAnimalKind } from '~/Interfaces/IAnimalKind';
import type { ICreateAnimalForm } from '~/Interfaces/ICreateAnimalForm';

const animalKindsStore = useAnimalKinds();
const animalStore = useAnimals();

const isOpen = ref(false);
const isSaving = ref(false);
const currentAnimalKind = ref<IAnimalKind>({});

const invertButton = () => {
  isOpen.value = !isOpen.value;
};

const openCreateModal = (animalElement: IAnimalKind) => {
  currentAnimalKind.value = animalElement;
  const bus = useEventBus<string>(`modal:createAnimalModal.open`);
  bus.emit();
};

const createAnimal = (form: ICreateAnimalForm) => {
  isSaving.value = true;
  animalStore
    .createAnimal({
      name: form.name,
      kind: currentAnimalKind.value?.kind || '',
    })
    .then(() => {
      isSaving.value = false;
      useEventBus<string>(`modal:createAnimalModal.close`).emit();
    });
};
</script>

<template>
  <div class="flex select-none">
    <button
      @click="invertButton"
      class="relative z-2 w-12 h-12 rounded-full bg-brown-500 text-white text-6 flex items-center justify-center transition hover:(bg-brown-400)"
    >
      <span class="mt--1">+</span>
    </button>
    <div
      :class="`relative z-1 bg-brown-50 p-1 pr-3 rounded-r-2 ml--7 transition-all flex ${
        isOpen
          ? `visible pl-11.5`
          : `invisible pointer-events-none opacity-0 pl-0`
      }`"
    >
      <button
        v-for="animal in animalKindsStore.animalKinds"
        :key="`animal-kind-${animal.kind}`"
        class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-[6px] last:mr-0 flex-shrink-0 border-brown-500 border-2 transition hover:scale-105"
        @click="openCreateModal(animal)"
      >
        <img
          class="w-6 h-6"
          :src="`/svg/${animal.kind}.svg`"
          :alt="`${animal.kind} icon`"
        />
      </button>
    </div>

    <AddAnimalModal
      :element="currentAnimalKind"
      :isSaving="isSaving"
      @save="createAnimal"
    />
  </div>
</template>
