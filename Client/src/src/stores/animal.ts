import { defineStore } from "pinia";

export const useAnimals = defineStore("animals", {
  state: () => ({
    animals: [],
  }),
  actions: {
    setAnimals(payload) {
      this.animals = payload;
    },
  },
});
