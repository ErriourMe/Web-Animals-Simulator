<script lang="ts" setup>
import { ref } from 'vue';
import BaseModal from '~/components/Utils/BaseModal.vue';
import LoadingElement from '~/components/Utils/LoadingElement.vue';

import type { Ref } from 'vue';
import type { IAnimalKind } from '~/Interfaces/IAnimalKind';
import type { ICreateAnimalForm } from '~/Interfaces/ICreateAnimalForm';

const form: Ref<ICreateAnimalForm> = ref({
  name: '',
});

const emit = defineEmits(['save']);

const props = withDefaults(
  defineProps<{
    element: IAnimalKind;
    isSaving: boolean;
  }>(),
  {}
);

const clearData = () => {
  form.value = {
    name: '',
  };
};
</script>

<template>
  <BaseModal id="createAnimalModal" @closed="clearData">
    <div class="flex flex-col items-center justify-center w-full">
      <img class="w-40 h-40" :src="`/svg/${props.element?.kind}.svg`" alt="" />

      <div class="text-xl text-brown mt-3">Как назвать питомца?</div>

      <div class="mt-8 w-2/3">
        <input
          type="text"
          class="px-3 py-2 outline-0 rounded-2 w-full"
          placeholder="Например, Барсик..."
          v-model="form.name"
        />
        <button
          :disabled="!form.name || isSaving"
          @click="emit('save', form)"
          class="w-full bg-brown rounded-3 flex justify-center text-white p-3 mt-3 disabled:(opacity-80 cursor-no-drop)"
        >
          <LoadingElement class="w-6 h-6" v-if="isSaving" />
          <template v-else> Создать питомца </template>
        </button>
      </div>
    </div>
  </BaseModal>
</template>
