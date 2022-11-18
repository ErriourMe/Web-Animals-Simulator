import { defineStore } from 'pinia';
import type { IAnimalKind } from '~/Interfaces/IAnimalKind';

export const useAnimalKinds = defineStore('animalKinds', {
  state: () => ({
    animalKinds: [] as IAnimalKind[],
  }),
  actions: {
    async loadAnimalKinds() {
      const animals = await fetch(
        `${import.meta.env.VITE_API_DOMAIN}/animal_kinds`
      );

      if (animals.ok) {
        this.setAnimalKinds(
          (await animals.json()).map((el: IAnimalKind) => ({
            ...el,
            available_count: 1,
          }))
        );
      }
    },
    getAnimalKind(kind: string): IAnimalKind | undefined {
      return this.animalKinds.find((el) => el.kind === kind);
    },
    setAnimalKinds(payload: IAnimalKind[]) {
      this.animalKinds = payload;
    },
    changeCountAnimalKinds(kind: string, count: number) {
      const index = this.animalKinds.findIndex((el) => el.kind === kind);
      if (index >= 0) {
        this.animalKinds[index].available_count =
          Number(this.animalKinds[index].available_count) + count;
      }
    },
  },
});
