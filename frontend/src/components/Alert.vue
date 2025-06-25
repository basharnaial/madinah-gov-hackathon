<template>
  <div
    v-if="message"
    :class="[
      'fixed z-50 top-20 left-1/2 transform -translate-x-1/2 min-w-[300px] max-w-md px-6 py-4 rounded shadow-lg flex items-center gap-3',
      type === 'success' ? 'bg-accent-500 text-white' : 'bg-red-100 text-red-800 border border-red-300',
      isRTL ? 'rtl font-arabic' : 'ltr font-sans'
    ]"
    role="alert"
    aria-live="assertive"
  >
    <svg v-if="type === 'success'" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <svg v-else class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
    <span class="flex-1">{{ message }}</span>
    <button @click="$emit('close')" class="ml-2 text-lg font-bold focus:outline-none">&times;</button>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useLanguageStore } from '@/stores/language';

const props = defineProps<{
  type: 'success' | 'error' | 'info' | 'warning',
  message: string
}>();

const languageStore = useLanguageStore();
const isRTL = computed(() => languageStore.isRTL);
</script> 