<script lang="ts" setup>
import { ref } from 'vue';
import HeaderLayout from '~/components/Layout/HeaderLayout.vue';
import AnimalItem from '~/components/AnimalItem.vue';
import { useAnimalKinds } from '~/stores/animalKind';
import { useAnimals } from '~/stores/animal';

const animalKindsStore = useAnimalKinds();
const animalsStore = useAnimals();
const loading = ref(true);

Promise.all([
  animalKindsStore.getAnimalKinds(),
  animalsStore.getAnimals(),
]).then(() => {
  loading.value = false;
});
</script>

<template>
  <div v-if="loading">Loading</div>
  <template v-else>
    <HeaderLayout />

    <main>
      <AnimalItem
        v-for="(animal, i) in animalsStore.animals"
        :key="`animal-${i}`"
      />
    </main>
  </template>
</template>

<style lang="postcss">
body {
  --at-apply: bg-gradient-to-b from-lightblue-500 to-blue-500 h-full;
}
</style>
