<script lang="ts" setup>
import HeaderLayout from '~/components/Layout/HeaderLayout.vue';
import AnimalItem from '~/components/AnimalItem.vue';
import { useAnimalKinds } from '~/stores/animalKind';
import { useAnimals } from '~/stores/animal';

const animalKindsStore = useAnimalKinds();
const animalsStore = useAnimals();

animalKindsStore.getAnimalKinds();
</script>

<template>
  <HeaderLayout />

  <main>
    <AnimalItem
      v-for="(animal, i) in animalsStore.animals"
      :key="`animal-${i}`"
    />
  </main>
</template>

<style lang="postcss">
body {
  --at-apply: bg-gradient-to-b from-lightblue-500 to-blue-500 h-full;
}
</style>
