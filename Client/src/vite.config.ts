import { fileURLToPath, URL } from "node:url";
import { unoCSSConfig } from "./config/unoCSS.config";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

import Unocss from "unocss/vite";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue(), Unocss(unoCSSConfig)],
  resolve: {
    alias: {
      "~": fileURLToPath(new URL("./src", import.meta.url)),
    },
  },
});
