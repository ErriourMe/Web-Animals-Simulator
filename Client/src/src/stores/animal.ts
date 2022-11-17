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
      fetch(`${import.meta.env.VITE_API_DOMAIN}/api/v1/animals`, {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload),
      })
        .then((res) => {
          this.addAnimal(payload);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    async getAnimals() {
      const animals = await fetch(
        `${import.meta.env.VITE_API_DOMAIN}/api/v1/animals`,
        {
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
          },
        }
      );
      if (animals.ok) this.setAnimals(await animals.json());
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
