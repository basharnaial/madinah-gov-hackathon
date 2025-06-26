<template>
  <div class="min-h-screen bg-gradient-to-br from-secondary-100 to-white flex items-center justify-center py-8 px-4">
    <div class="max-w-xl mx-auto">
      <!-- Success Card -->
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-primary-600 to-accent-500 px-6 py-8 text-center text-white relative overflow-hidden">
          <!-- Decorative circles -->
          <div class="absolute top-0 left-0 w-24 h-24 bg-white/10 rounded-full -translate-x-12 -translate-y-12"></div>
          <div class="absolute bottom-0 right-0 w-20 h-20 bg-white/10 rounded-full translate-x-10 translate-y-10"></div>
          
          <!-- Success Icon -->
          <div class="relative z-10">
            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-white/30">
              <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <h1 class="text-2xl font-bold mb-3">{{ $t('app.thank_you') }}</h1>
            <p class="text-lg opacity-90 leading-relaxed">{{ $t('app.registration_success') }}</p>
          </div>
        </div>
        
        <!-- Content -->
        <div class="px-6 py-6">
          <!-- Next Steps Section -->
          <div class="mb-6">
            <h2 class="text-xl font-bold text-primary-600 mb-4 flex items-center gap-2">
              <div class="w-6 h-6 bg-accent-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              {{ $t('thankyou.next_steps') }}
            </h2>
            
            <div class="space-y-3">
              <!-- Step 1 -->
              <div class="flex items-start gap-3 p-3 bg-secondary-50 rounded-lg border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="w-6 h-6 bg-primary-600 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-1">1</div>
                <div>
                  <p class="text-gray-800 leading-relaxed text-sm">{{ $t('thankyou.step1') }}</p>
                </div>
              </div>
              
              <!-- Step 2 -->
              <div class="flex items-start gap-3 p-3 bg-secondary-50 rounded-lg border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="w-6 h-6 bg-primary-600 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-1">2</div>
                <div>
                  <p class="text-gray-800 leading-relaxed text-sm">{{ $t('thankyou.step2') }}</p>
                </div>
              </div>
              
              <!-- Step 3 -->
              <div class="flex items-start gap-3 p-3 bg-secondary-50 rounded-lg border border-gray-100 hover:shadow-md transition-all duration-300">
                <div class="w-6 h-6 bg-primary-600 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-1">3</div>
                <div>
                  <p class="text-gray-800 leading-relaxed text-sm">{{ $t('thankyou.step3') }}</p>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Important Note -->
          <div class="bg-accent-50 border border-accent-200 rounded-lg p-4 mb-6">
            <div class="flex items-start gap-2">
              <div class="w-5 h-5 text-accent-600 flex-shrink-0 mt-0.5">
                <svg fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
              </div>
              <div>
                <h3 class="font-semibold text-accent-800 mb-1 text-sm">{{ languageStore.currentLanguage === 'ar' ? 'ملاحظة مهمة' : 'Important Note' }}</h3>
                <p class="text-accent-700 text-xs leading-relaxed">
                  {{ languageStore.currentLanguage === 'ar' 
                    ? 'يرجى التحقق من بريدك الإلكتروني بانتظام، بما في ذلك مجلد البريد العشوائي، للحصول على التحديثات.' 
                    : 'Please check your email regularly, including your spam folder, for updates.' }}
                </p>
              </div>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <router-link to="/" class="btn btn-primary px-6 py-2 shadow-lg hover:scale-105 transition-transform">
              <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              {{ $t('app.back_home') }}
            </router-link>

          </div>
        </div>
      </div>
      
      <!-- Additional Info Card -->
      <div class="mt-6 bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-gray-100 text-center">
        <p class="text-gray-600 text-xs leading-relaxed">
          {{ languageStore.currentLanguage === 'ar' 
            ? 'في حالة وجود أي استفسارات، يمكنك التواصل معنا عبر البريد الإلكتروني أو الهاتف المذكور في أسفل الصفحة.' 
            : 'If you have any questions, you can contact us via email or phone mentioned at the bottom of the page.' }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n';
import { useLanguageStore } from '@/stores/language';

const { t } = useI18n();
const languageStore = useLanguageStore();

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

<style scoped>
/* Add any additional custom styles if needed */
.btn {
  @apply inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200;
}

.btn-primary {
  @apply bg-primary-600 text-white hover:bg-primary-700;
}

.btn-outline {
  @apply border-2 border-gray-300 text-gray-700 hover:border-gray-400;
}
</style> 