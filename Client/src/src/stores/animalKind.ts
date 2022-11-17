import { defineStore } from 'pinia';
import type { IAnimalKind } from '~/Interfaces/IAnimalKind';

export const useAnimalKinds = defineStore('animalKinds', {
  state: () => ({
    animalKinds: [] as IAnimalKind[],
  }),
  actions: {
    async getAnimalKinds() {
      const animals = await fetch(
        `${import.meta.env.VITE_API_DOMAIN}/api/v1/animal_kinds`
      );

      this.setAnimalKinds(
        (await animals.json()).map((el: IAnimalKind) => ({
          ...el,
          available: 1,
        }))
      );
    },
    setAnimalKinds(payload: IAnimalKind[]) {
      this.animalKinds = payload;
    },
  },
});
