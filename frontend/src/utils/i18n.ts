import { createI18n } from 'vue-i18n';
import en from '../assets/lang/en.json';
import ar from '../assets/lang/ar.json';

const messages = {
  en,
  ar,
};

const i18n = createI18n({
  legacy: false,
  locale: localStorage.getItem('language') || 'ar',
  fallbackLocale: 'ar',
  messages,
  globalInjection: true,
});

export default i18n; 