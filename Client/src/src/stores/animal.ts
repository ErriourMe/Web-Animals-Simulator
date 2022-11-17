import { defineStore } from 'pinia';
import type { IAnimal } from '~/Interfaces/IAnimal';

export const useAnimals = defineStore('animals', {
  state: () => ({
    animals: [] as IAnimal[],
  }),
  actions: {
    setAnimals(payload: IAnimal[]) {
      this.animals = payload;
    },
    createAnimal(payload: IAnimal) {
      fetch(`${import.meta.env.VITE_API_DOMAIN}/api/v1/animal_kinds`, {
        method: 'POST',
        body: JSON.stringify(payload),
      })
        .then((res) => {
          this.addAnimal(payload);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addAnimal(payload: IAnimal) {
      this.animals.push({
        ...payload,
        age: 0,
        size: 0,
      });
    },
  },
});
