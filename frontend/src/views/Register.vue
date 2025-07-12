<template>
  <div class="min-h-screen bg-gradient-to-br from-secondary-100 to-white py-12 px-4">
    <div class="container-custom max-w-3xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-600 to-red-500 px-8 py-6 text-center text-white">
          <h1 class="text-3xl font-bold mb-2">{{ $t('app.registration_ended') }}</h1>
          <p class="text-white-100 opacity-90">{{ $t('app.registration_form_closed') }}</p>
        </div>
        
        <!-- Registration Closed Message -->
        <div class="px-8 py-12 text-center">
          <div class="max-w-md mx-auto">
            <div class="mb-8">
              <svg class="w-24 h-24 mx-auto text-red-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $t('app.registration_ended') }}</h2>
              <p class="text-gray-600 text-lg leading-relaxed">
                {{ $t('app.registration_deadline_passed') }}
              </p>
            </div>
            
            <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
              <div class="flex items-center justify-center gap-3 mb-3">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <span class="text-red-800 font-semibold">{{ $t('app.registration_closed') }}</span>
              </div>
              <p class="text-red-700 text-sm">{{ $t('app.registration_form_closed') }}</p>
            </div>
            
            <div class="space-y-4">
              <router-link 
                to="/" 
                class="inline-flex items-center gap-2 bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-all duration-200 font-medium"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ $t('app.back_home') }}
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t } = useI18n();
</script>

<style scoped>
/* Animation for the clock icon */
@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

svg {
  animation: pulse 2s ease-in-out infinite;
}

/* Hover effects */
.bg-primary-600:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}
</style> 