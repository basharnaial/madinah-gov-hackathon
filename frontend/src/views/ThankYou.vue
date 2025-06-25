<template>
  <div class="container-custom py-20 max-w-2xl mx-auto">
    <div class="card text-center">
      <div class="mb-6">
        <div class="w-20 h-20 bg-accent-500 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-primary-500 mb-4">{{ $t('app.thank_you') }}</h1>
        <p class="text-lg text-gray-600 mb-8">{{ $t('app.registration_success') }}</p>
      </div>
      
      <div class="bg-secondary-100 rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold text-primary-500 mb-4">ما هي الخطوات التالية؟</h2>
        <ul class="text-left space-y-2 text-gray-700">
          <li class="flex items-start gap-2">
            <span class="w-2 h-2 bg-accent-500 rounded-full mt-2 flex-shrink-0"></span>
            <span>سيتم مراجعة طلبك من قبل فريق المنظمين</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="w-2 h-2 bg-accent-500 rounded-full mt-2 flex-shrink-0"></span>
            <span>ستتلقى إشعاراً عبر البريد الإلكتروني عند الموافقة على طلبك</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="w-2 h-2 bg-accent-500 rounded-full mt-2 flex-shrink-0"></span>
            <span>سيتم إرسال تفاصيل إضافية حول الحدث والجدول الزمني</span>
          </li>
        </ul>
      </div>
      
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <router-link to="/" class="btn btn-primary">
          {{ $t('app.back_home') }}
        </router-link>
        <button @click="scrollToTop" class="btn btn-outline">
          <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
          </svg>
          العودة للأعلى
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

<style scoped>
.card {
  background: linear-gradient(135deg, #e8d9bb 0%, #f5ecd3 100%);
  border: 2px solid #b99166;
}
</style> 