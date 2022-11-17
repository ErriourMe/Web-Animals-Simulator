import { colors } from './unoCSS/colors';
import {
  presetWind,
  transformerDirectives,
  transformerVariantGroup,
} from 'unocss';

export const unoCSSConfig: object = {
  preflight: true, // Normalize css

  presets: [presetWind()],
  transformers: [transformerDirectives(), transformerVariantGroup()],
  shortcuts: [],
  rules: [],
  safelist: ['max-w-sm', 'max-w-md', 'max-w-lg', 'max-w-xl', 'max-w-2xl'],
  theme: {
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      '2xl': '1536px',
      fhd: '1920px',
      '2k': '2560px',
    },
    fontFamily: {},
    colors,
  },
};
