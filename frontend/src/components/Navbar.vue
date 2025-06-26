<template>
  <nav :class="[isRTL ? 'rtl' : 'ltr', 'sticky top-0 z-30 w-full flex justify-center bg-transparent']">
    <div class="w-full max-w-7xl flex items-center justify-between bg-accent-500   px-4 py-2 shadow-2xl">
      <!-- Logo & Title -->
      <router-link to="/" class="flex items-center gap-2">
        <div class="flex flex-col items-end">
          <img src="/Logo-ar.png" style="filter: brightness(0) invert(1);" alt="Madinah Hackathon Logo" class="h-14 w-38" />

        </div>
      </router-link>
      <!-- فاصل عمودي -->
      <div class="hidden md:block border-l-2 border-white/20 h-10 mx-4"></div>
      <!-- Desktop Links -->
      <div class="hidden md:flex items-center gap-8 flex-1 justify-center">
        <router-link to="/" class="text-white/90 text-lg font-semibold hover:text-accent-400 transition nav-link" :class="navLinkClass('/')">{{ $t('app.home') }}</router-link>
        <router-link to="/register" class="text-white/90 text-lg font-semibold hover:text-accent-400 transition nav-link" :class="navLinkClass('/register')">{{ $t('app.register') }}</router-link>
        <!-- <a href="#contact" class="text-white/90 text-lg font-semibold hover:text-accent-400 transition nav-link">{{ $t('app.contact') }}</a> -->
      </div>
      <!-- أزرار CTA -->
      <div class="hidden md:flex items-center gap-3">
        <button @click="toggleLanguage" class="bg--400 text-white font-bold px-5 py-2 rounded-full hover:bg-pink-500 transition">
          {{ currentLanguage === 'en' ? 'AR' : 'EN' }}
        </button>
        <router-link to="/register" class="bg-green-600 text-white font-bold px-6 py-2 rounded-full shadow-lg hover:bg-cyan-500 transition">
          {{ $t('app.register') }}
        </router-link>
      </div>
      <!-- Mobile Menu Button -->
      <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded focus:outline-none focus:ring-2 focus:ring-primary-500 ml-2">
        <svg v-if="!mobileOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <!-- Mobile Menu -->
    <div v-if="mobileOpen" class="md:hidden bg-gray-900 border-t border-white/10 px-4 pb-4 rounded-b-2xl shadow-2xl mx-2">
      <router-link to="/" class="block py-2 nav-link text-white/90 text-lg font-semibold hover:text-accent-400 transition" :class="navLinkClass('/')" @click="mobileOpen = false">{{ $t('app.home') }}</router-link>
      <router-link to="/register" class="block py-2 nav-link text-white/90 text-lg font-semibold hover:text-accent-400 transition" :class="navLinkClass('/register')" @click="mobileOpen = false">{{ $t('app.register') }}</router-link>
      <a href="#contact" class="block py-2 nav-link text-white/90 text-lg font-semibold hover:text-accent-400 transition" @click="mobileOpen = false">{{ $t('app.contact') }}</a>
      <button @click="toggleLanguage" class="mt-2 w-full px-3 py-2 rounded-full bg-pink-400 text-white font-bold hover:bg-pink-500 transition">
        {{ currentLanguage === 'en' ? 'AR' : 'EN' }}
      </button>
      <router-link to="/register" class="block w-full mt-2 px-3 py-2 rounded-full bg-cyan-400 text-white font-bold text-center shadow-lg hover:bg-cyan-500 transition">
        {{ $t('app.register') }}
      </router-link>
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
    ? 'font-bold text-accent-400 underline underline-offset-4'
    : '';
}
</script>

<style scoped>
.nav-link {
  @apply px-3 py-2 rounded transition-colors duration-200 font-medium;
}
</style> 