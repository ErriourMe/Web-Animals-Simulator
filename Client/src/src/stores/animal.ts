import { defineStore } from 'pinia';
import type { IAnimal } from '~/Interfaces/IAnimal';
import { useWindowSize } from '@vueuse/core';
import { useAnimalKinds } from '~/stores/animalKind';

export const useAnimals = defineStore('animals', {
  state: () => ({
    animals: [] as IAnimal[],
  }),
  actions: {
    setAnimals(payload: IAnimal[]) {
      this.animals = payload;
    },
    async createAnimal(payload: IAnimal) {
      const data = await fetch(
        `${import.meta.env.VITE_API_DOMAIN}/api/v1/animals`,
        {
          method: 'POST',
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(payload),
        }
      );

      if (data.ok) {
        this.addAnimal(payload);
        useAnimalKinds().changeCountAnimalKinds(payload.kind, -1);
      } else {
        return Promise.reject(await data.json());
      }
    },
    async loadAnimals() {
      const data = await fetch(
        `${import.meta.env.VITE_API_DOMAIN}/api/v1/animals`,
        {
          headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
          },
        }
      );

      if (data.ok) {
        const animals = await data.json();
        const { width, height } = useWindowSize();
        const areaSize: number =
          width.value / animals.length < 300
            ? width.value / animals.length
            : 300;
        const offset: number =
          (width.value - areaSize * animals.length) / 2 > 0
            ? (width.value - areaSize * animals.length) / 2 + 80
            : 40;

        this.setAnimals(
          animals.map(
            (el: IAnimal, i: number): IAnimal => ({
              ...el,
              x: areaSize * i + offset,
              y: height.value / 2 - 40,
            })
          )
        );
      }
    },
    addAnimal(payload: IAnimal) {
      const { width, height } = useWindowSize();
      this.animals.push({
        ...payload,
        age: 0,
        size: 0,
        x: width.value / 2 + 40,
        y: height.value / 2 + 40,
      });
    },
    async deleteAnimal(name: string, delay: number = 0) {
      const index = this.animals.findIndex((el: IAnimal) => el.name === name);
      await fetch(`${import.meta.env.VITE_API_DOMAIN}/api/v1/animals/age`, {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name }),
      });

      setTimeout(() => {
        useAnimalKinds().changeCountAnimalKinds(this.animals[index].kind, 1);
        this.animals.splice(index, 1);
      }, delay);
    },
  },
});
