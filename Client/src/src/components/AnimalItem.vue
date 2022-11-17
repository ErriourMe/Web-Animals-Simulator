<script lang="ts" setup>
import { ref } from 'vue';
import { useDraggable } from '@vueuse/core';
import type { IAnimal } from '~/Interfaces/IAnimal';
import { useAnimalKinds } from '~/stores/animalKind';
import { useAnimals } from '~/stores/animal';

const props = withDefaults(
  defineProps<{
    animal: IAnimal;
  }>(),
  {}
);

const speed: number = 1;

const growth = ref(props.animal.size || 1);
const animalKindsStore = useAnimalKinds();
const animalsStore = useAnimals();
const currentAnimalKind = animalKindsStore.getAnimalKind(props.animal.kind);
const dead = ref(false);
const grown = ref(false);

const growthInterval = setInterval(() => {
  const nextGrowth = growth.value + (currentAnimalKind?.growth_factor || 1) * 2;
  if (nextGrowth >= (currentAnimalKind?.max_size || 0)) {
    grown.value = true;
    growth.value = currentAnimalKind?.max_size || 0;
    clearInterval(growthInterval);
  } else {
    growth.value = nextGrowth;
  }
}, 1000 / speed);

setTimeout(() => {
  clearInterval(growthInterval);
  dead.value = true;
  animalsStore.deleteAnimal(props.animal.name, 3000);
}, (((currentAnimalKind?.max_age || 10) - (props.animal.age || 0)) * 1000) / speed);

const item = ref<HTMLElement | null>(null);

const { style } = useDraggable(item, {
  initialValue: { x: props.animal.x ?? 5, y: props.animal.y ?? 5 },
});
</script>

<template>
  <div class="fixed" :style="style" ref="item">
    <div
      class="w-20 h-20 select-none flex flex-col items-center cursor-grab active:cursor-grabbing transition-all duration-500"
      :style="`transform: scale(${1 + growth / 50})`"
    >
      <img
        :class="`w-full h-full ${dead ? `grayscale` : ``}`"
        :src="`/svg/${props.animal.kind}.svg`"
        :alt="`${props.animal.kind} icon`"
        draggable="false"
      />
      <div class="mt-2 text-sm font-semibold">
        {{ props.animal.name }}
      </div>
      <div class="text-red text-[8px] uppercase font-bold mt--0.5" v-if="dead">
        Умер
      </div>
      <div class="text-green text-[8px] uppercase font-bold mt--0.5" v-else>
        {{ growth.toFixed(0) }} / {{ currentAnimalKind?.max_size }}
      </div>
    </div>
  </div>
</template>
