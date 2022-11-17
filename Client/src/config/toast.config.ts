import type { PluginOptions } from 'vue-toastification/src/types';
import { POSITION } from 'vue-toastification/src/ts/constants';

export const toastConfig: PluginOptions = {
  transition: 'Vue-Toastification__fade',
  position: POSITION.TOP_RIGHT,
  icon: false,
  closeButton: false,
  hideProgressBar: true,
};
