import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import type { Language } from '@/types';

export const useLanguageStore = defineStore('language', () => {
  const currentLanguage = ref<Language>('en');

  // Initialize language from localStorage
  const savedLanguage = localStorage.getItem('language') as Language;
  if (savedLanguage && ['en', 'ar'].includes(savedLanguage)) {
    currentLanguage.value = savedLanguage;
  }

  const isRTL = computed(() => currentLanguage.value === 'ar');
  const isLTR = computed(() => currentLanguage.value === 'en');

  function setLanguage(language: Language) {
    currentLanguage.value = language;
    localStorage.setItem('language', language);
    
    // Update HTML attributes
    document.documentElement.lang = language;
    document.documentElement.dir = isRTL.value ? 'rtl' : 'ltr';
    
    // Update body class
    document.body.classList.toggle('rtl', isRTL.value);
    document.body.classList.toggle('ltr', isLTR.value);
  }

  function toggleLanguage() {
    const newLanguage: Language = currentLanguage.value === 'en' ? 'ar' : 'en';
    setLanguage(newLanguage);
  }

  // Initialize on store creation
  setLanguage(currentLanguage.value);

  return {
    currentLanguage,
    isRTL,
    isLTR,
    setLanguage,
    toggleLanguage,
  };
}); 