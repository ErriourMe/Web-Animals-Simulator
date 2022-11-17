import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';

import Toast from 'vue-toastification';
import { toastConfig } from '../config/toast.config';

import '@unocss/reset/tailwind.css';
import 'uno.css';

import './assets/main.css';

const app = createApp(App);

app.use(createPinia());
app.use(Toast, toastConfig);

app.mount('#app');
