<template>
  <div :class="[isRTL ? 'rtl font-arabic' : 'ltr font-sans', 'min-h-screen flex flex-col bg-secondary-50 text-gray-900']">
    <Navbar />
    <main class="flex-1">
      <router-view />
    </main>
    <Footer />
    <Alert v-if="alert.message" :type="alert.type" :message="alert.message" @close="clearAlert" />
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { useLanguageStore } from '@/stores/language';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import Alert from '@/components/Alert.vue';
import { useUIStore } from '@/stores/ui';

const languageStore = useLanguageStore();
const isRTL = computed(() => languageStore.isRTL);

const uiStore = useUIStore();
const alert = computed(() => uiStore.alert);
const clearAlert = uiStore.clearAlert;
</script>

<style>
body.rtl {
  direction: rtl;
}
body.ltr {
  direction: ltr;
}
</style> 