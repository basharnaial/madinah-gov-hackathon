<template>
  <nav :class="[isRTL ? 'rtl' : 'ltr', 'sticky top-0 z-30 w-full bg-secondary-500 shadow-sm border-b border-secondary-300']">
    <div class="container-custom flex items-center justify-between h-16">
      <!-- Logo & Title -->
      <router-link to="/" class="flex items-center gap-2">
        <img src="/logo.svg" alt="Madinah Hackathon Logo" class="h-10 w-10" />
        <span class="text-xl font-bold tracking-tight" :class="isRTL ? 'font-arabic' : 'font-sans'" style="color: #24784d;">
          برمجان المدينة
        </span>
      </router-link>
      <!-- Desktop Links -->
      <div class="hidden md:flex items-center gap-6">
        <router-link to="/" class="nav-link" :class="navLinkClass('/')">{{ $t('app.home') }}</router-link>
        <router-link to="/register" class="nav-link" :class="navLinkClass('/register')">{{ $t('app.register') }}</router-link>
        <a href="#contact" class="nav-link">{{ $t('app.contact') }}</a>
        <button @click="toggleLanguage" class="ml-4 px-3 py-1 rounded text-primary-500 border border-primary-500 hover:bg-primary-100 transition">
          {{ currentLanguage === 'en' ? 'AR' : 'EN' }}
        </button>
      </div>
      <!-- Mobile Menu Button -->
      <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded focus:outline-none focus:ring-2 focus:ring-primary-500">
        <svg v-if="!mobileOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-primary-500">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-primary-500">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <!-- Mobile Menu -->
    <div v-if="mobileOpen" class="md:hidden bg-secondary-500 border-t border-secondary-300 px-4 pb-4">
      <router-link to="/" class="block py-2 nav-link" :class="navLinkClass('/')" @click="mobileOpen = false">{{ $t('app.home') }}</router-link>
      <router-link to="/register" class="block py-2 nav-link" :class="navLinkClass('/register')" @click="mobileOpen = false">{{ $t('app.register') }}</router-link>
      <a href="#contact" class="block py-2 nav-link" @click="mobileOpen = false">{{ $t('app.contact') }}</a>
      <button @click="toggleLanguage" class="mt-2 w-full px-3 py-1 rounded text-primary-500 border border-primary-500 hover:bg-primary-100 transition">
        {{ currentLanguage === 'en' ? 'AR' : 'EN' }}
      </button>
    </div>
  </nav>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import { useLanguageStore } from '@/stores/language';

const mobileOpen = ref(false);
const route = useRoute();
const languageStore = useLanguageStore();
const currentLanguage = computed(() => languageStore.currentLanguage);
const isRTL = computed(() => languageStore.isRTL);
const toggleLanguage = languageStore.toggleLanguage;

function navLinkClass(path: string) {
  return route.path === path
    ? 'font-bold text-primary-500 underline underline-offset-4'
    : 'text-primary-700 hover:text-primary-500';
}
</script>

<style scoped>
.nav-link {
  @apply px-3 py-2 rounded transition-colors duration-200 font-medium;
}
</style> 