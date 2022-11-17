<script lang="ts" setup>
import { ref } from 'vue';
import HeaderLayout from '~/components/Layout/HeaderLayout.vue';
import LoadingElement from '~/components/Utils/LoadingElement.vue';
import AnimalItem from '~/components/AnimalItem.vue';
import { useAnimalKinds } from '~/stores/animalKind';
import { useAnimals } from '~/stores/animal';

const animalKindsStore = useAnimalKinds();
const animalsStore = useAnimals();
const isLoading = ref(true);

Promise.all([
  animalKindsStore.loadAnimalKinds(),
  animalsStore.loadAnimals(),
]).then(() => {
  isLoading.value = false;
});
</script>

<template>
  <div v-if="isLoading">
    <div class="w-[100vw] h-[100vh] flex items-center justify-center">
      <LoadingElement class="w-50 h-50" />
    </div>
  </div>
  <template v-else>
    <HeaderLayout />

    <main>
      <AnimalItem
        v-for="(animal, i) in animalsStore.animals"
        :animal="animal"
        :key="`animal-${i}`"
      />
    </main>
  </template>
</template>
