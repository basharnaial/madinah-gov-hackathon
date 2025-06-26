<template>
  <nav :class="[isRTL ? 'rtl' : 'ltr', 'sticky top-0 z-30 w-full bg-accent-500 shadow-2xl']">
    <div class="w-full max-w-7xl mx-auto flex items-center justify-between px-4 py-2">
      <!-- Logo & Title -->
      <router-link to="/" class="flex items-center gap-2">
        <div class="flex flex-col items-end">
          <img src="/Logo-ar.png" style="filter: brightness(0) invert(1);" alt="Madinah Hackathon Logo" class="h-14 w-38" />
        </div>
      </router-link>
      
      <!-- Vertical divider -->
      <div class="hidden md:block border-l-2 border-white/20 h-10 mx-4"></div>
      
      <!-- Desktop Links -->
      <div class="hidden md:flex items-center gap-8 flex-1 justify-center">
        <router-link to="/" class="text-white/90 text-lg font-semibold hover:text-accent-1000 transition nav-link" :class="navLinkClass('/')">{{ $t('app.home') }}</router-link>
        <router-link to="/register" class="text-white/90 text-lg font-semibold hover:text-accent-1000 transition nav-link" :class="navLinkClass('/register')">{{ $t('app.register') }}</router-link>
      </div>
      
      <!-- CTA buttons -->
      <div class="hidden md:flex items-center gap-3">
        <button @click="toggleLanguage" class="bg-primary-600 text-white font-bold px-5 py-2 rounded-full hover:bg-primary-700 transition">
          {{ currentLanguage === 'en' ? 'AR' : 'EN' }}
        </button>
        <router-link to="/register" class="bg-green-600 text-white font-bold px-6 py-2 rounded-full shadow-lg hover:bg-green-700 transition">
          {{ $t('app.register') }}
        </router-link>
      </div>
      
      <!-- Mobile Menu Button -->
      <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/20">
        <svg v-if="!mobileOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-white">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    
    <!-- Mobile Menu -->
    <transition name="mobile-menu">
      <div v-if="mobileOpen" class="md:hidden bg-accent-600 border-t border-white/10 overflow-hidden">
        <div class="px-4 py-3 space-y-2">
          <router-link 
            to="/" 
            class="block py-3 px-4 text-white text-lg font-semibold hover:bg-accent-700 rounded-lg transition-colors" 
            :class="navLinkClass('/')" 
            @click="mobileOpen = false"
          >
            {{ $t('app.home') }}
          </router-link>
          
          <router-link 
            to="/register" 
            class="block py-3 px-4 text-white text-lg font-semibold hover:bg-accent-700 rounded-lg transition-colors" 
            :class="navLinkClass('/register')" 
            @click="mobileOpen = false"
          >
            {{ $t('app.register') }}
          </router-link>
          
          <!-- Language Toggle Button -->
          <button 
            @click="toggleLanguage" 
            class="w-full mt-3 py-3 px-4 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors"
          >
            {{ currentLanguage === 'en' ? 'العربية' : 'English' }}
          </button>
          
          <!-- Register CTA Button -->
          <router-link 
            to="/register" 
            class="block w-full mt-2 py-3 px-4 bg-green-600 text-white font-bold text-center rounded-lg shadow-lg hover:bg-green-700 transition-colors"
            @click="mobileOpen = false"
          >
            {{ $t('app.register') }}
          </router-link>
        </div>
      </div>
    </transition>
  </nav>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
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

// Close mobile menu when clicking outside
function handleClickOutside(event: Event) {
  const target = event.target as HTMLElement;
  const nav = document.querySelector('nav');
  if (nav && !nav.contains(target) && mobileOpen.value) {
    mobileOpen.value = false;
  }
}

// Close mobile menu on route change
function closeMobileMenu() {
  mobileOpen.value = false;
}

// Control body scroll when mobile menu is open
watch(mobileOpen, (isOpen) => {
  if (isOpen) {
    document.body.classList.add('mobile-menu-open');
  } else {
    document.body.classList.remove('mobile-menu-open');
  }
});

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
  // Clean up body class
  document.body.classList.remove('mobile-menu-open');
});
</script>

<style scoped>
.nav-link {
  @apply px-3 py-2 rounded transition-colors duration-200 font-medium;
}


/* Mobile menu animation */
.mobile-menu-enter-active,
.mobile-menu-leave-active {
  transition: all 0.3s ease-in-out;
  transform-origin: top;
}

.mobile-menu-enter-from {
  opacity: 0;
  transform: scaleY(0);
  max-height: 0;
}

.mobile-menu-enter-to {
  opacity: 1;
  transform: scaleY(1);
  max-height: 500px;
}

.mobile-menu-leave-from {
  opacity: 1;
  transform: scaleY(1);
  max-height: 500px;
}

.mobile-menu-leave-to {
  opacity: 0;
  transform: scaleY(0);
  max-height: 0;
}

/* Ensure mobile menu doesn't overflow */
@media (max-width: 768px) {
  nav {
    @apply relative;
  }
  
  .mobile-menu {
    @apply absolute top-full left-0 right-0 z-50;
  }
}

/* RTL Support */
.rtl {
  direction: rtl;
}

.ltr {
  direction: ltr;
}

/* Fix for mobile menu positioning */
.md\:hidden {
  position: relative;
}

/* Prevent body scroll when mobile menu is open */
body.mobile-menu-open {
  overflow: hidden;
}
</style> 