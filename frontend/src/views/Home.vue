<template>
  <div>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-secondary-500 to-secondary-300 py-18 md:py-20 overflow-hidden">
      <!-- Emara Pattern as full background for hero section -->
      <img
        src="/Emara-bg.svg"
        alt="Emara Pattern"
        class="absolute inset-0 w-full h-full object-cover opacity-70 z-0 pointer-events-none select-none hero-bg-animate"
        style="object-fit: cover;"
      />
      <div class="container-custom text-center relative z-10 mt-10 mb-10">
        <h1 class="text-4xl md:text-6xl font-extrabold text-muted-600 text-primary-600 mb-6 drop-shadow-sm animate-scale-in">
          {{ $t('app.hero_title') }}
        </h1>
        <p class="text-xl md:text-2xl text-gray-700 mb-10 max-w-3xl mx-auto animate-fade-in delay-200">
          {{ $t('app.hero_subtitle') }}
        </p>
        <!-- Countdown Timer -->
        <div
          class="countdown-container mx-auto mt-10 mb-6 max-w-3xl rounded-3xl shadow-lg flex flex-wrap justify-center items-center gap-0 bg-gradient-to-r from-accent-500 to-muted-300 p-6 animate-bounce-in delay-400"
        >
          <div
            v-for="(item, idx) in countdown"
            :key="item.label"
            class="flex flex-col items-center flex-1"
            :class="idx !== 0 ? 'border-l border-dashed border-primary-600' : ''"
          >
            <span class="countdown-number text-4xl md:text-5xl font-extrabold text-primary-600 animate-number-count">{{ item.value }}</span>
            <span class="text-lg md:text-xl font-bold text-accent-500 mt-1 animate-slide-down">{{ $t(item.label) }}</span>
          </div>
        </div>
        <p class="text-center  text-primary-600 font-semibold text-sm mb-2">
          {{ $t('app.registration_closes') }} {{ $t('app.event_date') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in delay-600">


          <router-link
           to="/register"
            class="btn btn-primary text-lg px-8 py-3 shadow-lg hover:scale-105 transition-transform"
          >
            {{ $t('app.register') }}
          </router-link>
          <a @click="scrollToAbout" class="btn btn-outline text-lg px-8 py-3 hover:bg-gray-100 transition-colors cursor-pointer">
            {{ $t('app.learn_more') }}
          </a>
        </div>
      </div>
    </section>



    <!-- About Section -->
    <section id="about" class="py-16 bg-gradient-to-br from-secondary-100 to-white border-b border-gray-100">
      <div class="max-w-3xl mx-auto bg-white/80 rounded-3xl shadow-lg px-8 py-12 text-center animate-fade-in delay-300">
        <h2 class="text-4xl font-extrabold text-primary-600 mb-4 drop-shadow-sm">{{ $t('app.about_title') }}</h2>
        <h3 class="text-2xl font-semibold text-primary-500 mb-6">          {{ $t('app.hero_title') }}
        </h3>
        <p class="text-gray-700 mb-8 leading-relaxed text-lg">
          {{ $t('app.about_description') }}
        </p>
        <ul class="flex flex-wrap justify-center gap-4 mt-8">
          <li class="flex items-center gap-3 bg-secondary-100 rounded-xl px-5 py-3 shadow-sm min-w-[220px]">
            <span class="w-3 h-3 bg-accent-500 rounded-full"></span>
            <span class="text-gray-800 font-medium">{{ $t('app.feature1') }}</span>
          </li>
          <li class="flex items-center gap-3 bg-secondary-100 rounded-xl px-5 py-3 shadow-sm min-w-[220px]">
            <span class="w-3 h-3 bg-accent-500 rounded-full"></span>
            <span class="text-gray-800 font-medium">{{ $t('app.feature2') }}</span>
          </li>
          <li class="flex items-center gap-3 bg-secondary-100 rounded-xl px-5 py-3 shadow-sm min-w-[220px]">
            <span class="w-3 h-3 bg-accent-500 rounded-full"></span>
            <span class="text-gray-800 font-medium">{{ $t('app.feature3') }}</span>
          </li>
          <li class="flex items-center gap-3 bg-secondary-100 rounded-xl px-5 py-3 shadow-sm min-w-[220px]">
            <span class="w-3 h-3 bg-accent-500 rounded-full"></span>
            <span class="text-gray-800 font-medium">{{ $t('app.feature4') }}</span>
          </li>
        </ul>
      </div>
    </section>

    <!-- Goals Section -->
        <!-- Goals Section -->
    <section class="py-16 bg-white">
      <div class="container-custom">
        <h2 class="text-3xl font-bold text-primary-600 text-center mb-12">{{ $t('admin.goals_title') }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <!-- Goal 1 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full animate-fade-in delay-100"
               @mouseenter="activeTooltip = 0" @mouseleave="activeTooltip = null">
            <div class="goal-card bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
              <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center mb-2 shadow-md">
                <CogIcon class="w-6 h-6 text-white" />
              </div>
              <h3 class="text-xs font-semibold text-primary-600 leading-tight">{{ $t('admin.goal1_title') }}</h3>
            </div>
            <div v-if="activeTooltip === 0" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-50 w-44 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-lg">
              <div class="text-center">
                <div class="font-semibold mb-1">{{ $t('admin.goal1_title') }}</div>
                <div class="text-gray-300 leading-relaxed">{{ $t('admin.goal1_desc') }}</div>
              </div>
              <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
          </div>
          <!-- Goal 2 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full animate-fade-in delay-200"
               @mouseenter="activeTooltip = 1" @mouseleave="activeTooltip = null">
            <div class="goal-card bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
              <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center mb-2 shadow-md">
                <CheckCircleIcon class="w-6 h-6 text-white" />
              </div>
              <h3 class="text-xs font-semibold text-primary-600 leading-tight">{{ $t('admin.goal2_title') }}</h3>
            </div>
            <div v-if="activeTooltip === 1" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-50 w-44 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-lg">
              <div class="text-center">
                <div class="font-semibold mb-1">{{ $t('admin.goal2_title') }}</div>
                <div class="text-gray-300 leading-relaxed">{{ $t('admin.goal2_desc') }}</div>
              </div>
              <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
          </div>
          <!-- Goal 3 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full animate-fade-in delay-300"
               @mouseenter="activeTooltip = 2" @mouseleave="activeTooltip = null">
            <div class="goal-card bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
              <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center mb-2 shadow-md">
                <LightBulbIcon class="w-6 h-6 text-white" />
              </div>
              <h3 class="text-xs font-semibold text-primary-600 leading-tight">{{ $t('admin.goal3_title') }}</h3>
            </div>
            <div v-if="activeTooltip === 2" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-50 w-44 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-lg">
              <div class="text-center">
                <div class="font-semibold mb-1">{{ $t('admin.goal3_title') }}</div>
                <div class="text-gray-300 leading-relaxed">{{ $t('admin.goal3_desc') }}</div>
              </div>
              <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
          </div>
          <!-- Goal 4 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full animate-fade-in delay-400"
               @mouseenter="activeTooltip = 3" @mouseleave="activeTooltip = null">
            <div class="goal-card bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
              <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center mb-2 shadow-md">
                <TrophyIcon class="w-6 h-6 text-white" />
              </div>
              <h3 class="text-xs font-semibold text-primary-600 leading-tight">{{ $t('admin.goal4_title') }}</h3>
            </div>
            <div v-if="activeTooltip === 3" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-50 w-44 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-lg">
              <div class="text-center">
                <div class="font-semibold mb-1">{{ $t('admin.goal4_title') }}</div>
                <div class="text-gray-300 leading-relaxed">{{ $t('admin.goal4_desc') }}</div>
              </div>
              <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
          </div>
          <!-- Goal 5 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full animate-fade-in delay-500"
               @mouseenter="activeTooltip = 4" @mouseleave="activeTooltip = null">
            <div class="goal-card bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
              <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center mb-2 shadow-md">
                <UserGroupIcon class="w-6 h-6 text-white" />
              </div>
              <h3 class="text-xs font-semibold text-primary-600 leading-tight">{{ $t('admin.goal5_title') }}</h3>
            </div>
            <div v-if="activeTooltip === 4" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-50 w-44 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-lg">
              <div class="text-center">
                <div class="font-semibold mb-1">{{ $t('admin.goal5_title') }}</div>
                <div class="text-gray-300 leading-relaxed">{{ $t('admin.goal5_desc') }}</div>
              </div>
              <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
          </div>
          <!-- Goal 6 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full animate-fade-in delay-600"
               @mouseenter="activeTooltip = 5" @mouseleave="activeTooltip = null">
            <div class="goal-card bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
              <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center mb-2 shadow-md">
                <BuildingOfficeIcon class="w-6 h-6 text-white" />
              </div>
              <h3 class="text-xs font-semibold text-primary-600 leading-tight">{{ $t('admin.goal6_title') }}</h3>
            </div>
            <div v-if="activeTooltip === 5" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-50 w-44 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-lg">
              <div class="text-center">
                <div class="font-semibold mb-1">{{ $t('admin.goal6_title') }}</div>
                <div class="text-gray-300 leading-relaxed">{{ $t('admin.goal6_desc') }}</div>
              </div>
              <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
          </div>
          <!-- Goal 7 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full animate-fade-in delay-700"
               @mouseenter="activeTooltip = 6" @mouseleave="activeTooltip = null">
            <div class="goal-card bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
              <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center mb-2 shadow-md">
                <UserGroupIcon class="w-6 h-6 text-white" />
              </div>
              <h3 class="text-xs font-semibold text-primary-600 leading-tight">{{ $t('admin.goal7_title') }}</h3>
            </div>
            <div v-if="activeTooltip === 6" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-50 w-44 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-lg">
              <div class="text-center">
                <div class="font-semibold mb-1">{{ $t('admin.goal7_title') }}</div>
                <div class="text-gray-300 leading-relaxed">{{ $t('admin.goal7_desc') }}</div>
              </div>
              <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
          </div>
          <!-- Goal 8 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full animate-fade-in delay-800"
               @mouseenter="activeTooltip = 7" @mouseleave="activeTooltip = null">
            <div class="goal-card bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
              <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center mb-2 shadow-md">
                <ChatBubbleLeftRightIcon class="w-6 h-6 text-white" />
              </div>
              <h3 class="text-xs font-semibold text-primary-600 leading-tight">{{ $t('admin.goal8_title') }}</h3>
            </div>
            <div v-if="activeTooltip === 7" class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 z-50 w-44 bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-lg">
              <div class="text-center">
                <div class="font-semibold mb-1">{{ $t('admin.goal8_title') }}</div>
                <div class="text-gray-300 leading-relaxed">{{ $t('admin.goal8_desc') }}</div>
              </div>
              <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-900"></div>
            </div>
          </div>
                </div>
      </div>
    </section>

    <!-- Target Audiences Section -->
    <section class="py-16 bg-secondary-50 border-b border-gray-100">
      <div class="container-custom">
        <h2 class="text-2xl md:text-3xl font-bold text-primary-500 text-center mb-8">
          {{ $t('app.target_audiences_title') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Government entities -->
          <div class="bg-secondary-50 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 p-6 flex flex-col items-center text-center animate-fade-in-left delay-100">
            <BuildingOfficeIcon class="w-10 h-10 text-accent-500 mb-3" />
            <div class="font-bold text-primary-600 text-lg mb-1">{{ $t('app.target_audiences_gov') }}</div>
            <div class="text-gray-600 text-sm">{{ $t('app.target_audiences_gov_desc') }}</div>
          </div>
          <!-- Professionals and innovators -->
          <div class="bg-secondary-50 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 p-6 flex flex-col items-center text-center animate-scale-in delay-200">
            <LightBulbIcon class="w-10 h-10 text-accent-500 mb-3" />
            <div class="font-bold text-primary-600 text-lg mb-1">{{ $t('app.target_audiences_pro') }}</div>
            <div class="text-gray-600 text-sm">{{ $t('app.target_audiences_pro_desc') }}</div>
          </div>
          <!-- Students and recent graduates -->
          <div class="bg-secondary-50 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 p-6 flex flex-col items-center text-center animate-fade-in-right delay-300">
            <UserGroupIcon class="w-10 h-10 text-accent-500 mb-3" />
            <div class="font-bold text-primary-600 text-lg mb-1">{{ $t('app.target_audiences_students') }}</div>
            <div class="text-gray-600 text-sm">{{ $t('app.target_audiences_students_desc') }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Official Timeline Section -->

    <!-- Vertical Timeline Section -->
    <section class="py-16 bg-white">
      <div class="container-custom">
        <h2 class="text-3xl font-bold text-primary-600 text-center mb-12">{{ $t('admin.timeline_title') }}</h2>
        <div class="relative flex flex-col items-center">
          <!-- Vertical line in the center -->
          <div class="absolute left-1/2 top-0 w-1 bg-gradient-to-b from-accent-500 to-primary-600 h-full -translate-x-1/2 z-0"></div>
          <div
            v-for="(step, idx) in steps"
            :key="idx"
            :class="[ 'relative flex w-full mb-16', idx % 2 === 0 ? 'flex-row-reverse' : 'flex-row' ]"
            :ref="el => setStepRef(el, idx)"
            :data-idx="idx"
          >
            <!-- Card: alternating right/left -->
            <div class="w-1/2 flex" :class="idx % 2 === 0 ? 'justify-end pr-8' : 'justify-start pl-8'">
              <div
                class="bg-secondary-500 rounded-xl shadow-lg p-6 text-right max-w-md transition-all duration-700"
                :class="[
                  idx % 2 === 0 ? 'mr-auto border-l-8 border-accent-500' : 'ml-auto border-r-8 border-primary-600',
                  stepsInView[idx] ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'
                ]"
              >
                <div class="text-lg font-bold text-primary-600 mb-2">{{ step.title }}</div>
                <div v-if="step.subtitle" class="text-sm font-semibold text-accent-500 mb-2">{{ step.subtitle }}</div>
                <div v-if="step.description" class="text-gray-700 text-sm leading-relaxed">{{ step.description }}</div>
              </div>
            </div>
            <!-- Circle in the middle of the line -->
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 transition-all duration-700"
              :class="stepsInView[idx] ? 'opacity-100 scale-100' : 'opacity-0 scale-75'"
            >
              <div class="w-12 h-12 rounded-full bg-white border-4 border-primary-600 flex items-center justify-center shadow-lg ring-4 ring-muted-300 animate-pulse">
                <span class="text-2xl font-bold text-primary-600">{{ idx + 1 }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-secondary-50 border-b border-gray-100">
      <div class="container-custom">
        <h2 class="text-3xl font-bold text-primary-500 text-center mb-12">{{ $t('app.faq_title') }}</h2>
        <div class="max-w-3xl mx-auto space-y-4">
          <div v-for="(faq, index) in faqs" :key="faq.id" class="faq-item card rounded-2xl p-6 bg-white border border-gray-100 animate-fade-in" :class="`delay-${(index + 1) * 100}`">
            <button @click="toggleFaq(faq.id)" class="w-full text-right flex justify-between items-center focus:outline-none">
              <h3 class="text-lg font-semibold text-primary-500">{{ faq.question }}</h3>
              <svg :class="['w-5 h-5 text-primary-500 transition-transform', { 'rotate-180': openFaq === faq.id }]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div v-if="openFaq === faq.id" class="mt-4 text-gray-700 transition-all duration-300">
              {{ faq.answer }}
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-accent-500 text-white relative overflow-hidden">
      <div class="container-custom text-center relative z-10">
        <h2 class="text-3xl font-bold mb-4 animate-scale-in">{{ $t('app.cta_title') }}</h2>
        <p class="text-xl mb-8 opacity-90 animate-fade-in delay-200">{{ $t('app.cta_subtitle') }}</p>
        <router-link to="/register" class="btn bg-white text-accent-500 hover:bg-gray-100 text-lg px-8 py-3 shadow-lg animate-bounce-in delay-400">
          {{ $t('app.register') }}
        </router-link>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, nextTick, computed } from 'vue';
import { useI18n } from 'vue-i18n';
import { useLanguageStore } from '@/stores/language';
import { CogIcon, CheckCircleIcon, LightBulbIcon, TrophyIcon, UserGroupIcon, ChatBubbleLeftRightIcon, BuildingOfficeIcon } from '@heroicons/vue/24/solid';
import type { ComponentPublicInstance } from 'vue';

const { t } = useI18n();
const languageStore = useLanguageStore();

const openFaq = ref<number | null>(null);
const activeTooltip = ref<number | null>(null);

// Countdown Timer logic
const targetDate = new Date('2025-07-12T23:59:59');
const countdown = ref([
  { label: 'app.days', value: 0 },
  { label: 'app.hours', value: 0 },
  { label: 'app.minutes', value: 0 },
  { label: 'app.seconds', value: 0 },
]);

function updateCountdown() {
  const now = new Date();
  let diff = Math.max(0, targetDate.getTime() - now.getTime());
  const days = Math.floor(diff / (1000 * 60 * 60 * 24));
  diff -= days * (1000 * 60 * 60 * 24);
  const hours = Math.floor(diff / (1000 * 60 * 60));
  diff -= hours * (1000 * 60 * 60);
  const minutes = Math.floor(diff / (1000 * 60));
  diff -= minutes * (1000 * 60);
  const seconds = Math.floor(diff / 1000);

  countdown.value = [
    { label: 'app.days', value: days },
    { label: 'app.hours', value: hours },
    { label: 'app.minutes', value: minutes },
    { label: 'app.seconds', value: seconds },
  ];
}

let interval: ReturnType<typeof setInterval>;
onMounted(() => {
  updateCountdown();
  interval = setInterval(updateCountdown, 1000);
});
onUnmounted(() => {
  clearInterval(interval);
});



const steps = computed(() => [
  {
    title: t('admin.timeline_step1_title'),
    subtitle: t('admin.timeline_step1_subtitle'),
    description: '',
  },
  {
    title: t('admin.timeline_step2_title'),
    subtitle: t('admin.timeline_step2_subtitle'),
    description: '',
  },
  {
    title: t('admin.timeline_step3_title'),
    subtitle: t('admin.timeline_step3_subtitle'),
    description: '',
  },
  {
    title: t('admin.timeline_step4_title'),
    subtitle: t('admin.timeline_step4_subtitle'),
    description: '',
  },
  {
    title: t('admin.timeline_step5_title'),
    subtitle: t('admin.timeline_step5_subtitle'),
    description: '',
  },
]);

// Reveal on scroll logic
const stepsInView = ref<boolean[]>(Array(5).fill(false));
const stepRefs = ref<HTMLElement[]>([]);
function setStepRef(el: Element | ComponentPublicInstance | null, idx: number) {
  if (el instanceof HTMLElement) stepRefs.value[idx] = el;
}
let observer: IntersectionObserver | null = null;

onMounted(() => {
  nextTick(() => {
    observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          const idx = Number((entry.target as HTMLElement).dataset.idx);
          if (entry.isIntersecting) {
            stepsInView.value[idx] = true;
          } else {
            stepsInView.value[idx] = false;
          }
        });
      },
      { threshold: 0.3 }
    );
    stepRefs.value.forEach((el) => {
      if (el) observer!.observe(el);
    });
  });
});

onUnmounted(() => {
  if (observer) observer.disconnect();
});

const faqs = computed(() => [
  {
    id: 1,
    question: t('app.faq1_question'),
    answer: t('app.faq1_answer')
  },
  {
    id: 2,
    question: t('app.faq2_question'),
    answer: t('app.faq2_answer')
  },
  {
    id: 4,
    question: t('app.faq4_question'),
    answer: t('app.faq4_answer')
  }
]);

function toggleFaq(id: number) {
  openFaq.value = openFaq.value === id ? null : id;
}

function scrollToAbout() {
  const el = document.getElementById('about');
  if (el && el instanceof HTMLElement) {
    window.scrollTo({ top: el.offsetTop, behavior: 'smooth' });
  }
}
</script>

<style scoped>
.card {
  transition: all 0.3s ease;
}

/* Enhanced fade-in animation with smooth easing */
@keyframes fade-in {
  from { 
    opacity: 0; 
    transform: translateY(30px); 
  }
  to { 
    opacity: 1; 
    transform: translateY(0); 
  }
}

@keyframes fade-in-left {
  from { 
    opacity: 0; 
    transform: translateX(-30px); 
  }
  to { 
    opacity: 1; 
    transform: translateX(0); 
  }
}

@keyframes fade-in-right {
  from { 
    opacity: 0; 
    transform: translateX(30px); 
  }
  to { 
    opacity: 1; 
    transform: translateX(0); 
  }
}

@keyframes scale-in {
  from { 
    opacity: 0; 
    transform: scale(0.8); 
  }
  to { 
    opacity: 1; 
    transform: scale(1); 
  }
}

@keyframes slide-down {
  from { 
    opacity: 0; 
    transform: translateY(-20px); 
  }
  to { 
    opacity: 1; 
    transform: translateY(0); 
  }
}

@keyframes bounce-in {
  0% { 
    opacity: 0; 
    transform: scale(0.3); 
  }
  50% { 
    opacity: 1; 
    transform: scale(1.05); 
  }
  70% { 
    transform: scale(0.9); 
  }
  100% { 
    opacity: 1; 
    transform: scale(1); 
  }
}

@keyframes float-bg {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  25% { transform: translateY(-10px) rotate(1deg); }
  50% { transform: translateY(-20px) rotate(0deg); }
  75% { transform: translateY(-10px) rotate(-1deg); }
}

@keyframes pulse-glow {
  0%, 100% { 
    box-shadow: 0 0 20px rgba(184, 144, 102, 0.3);
  }
  50% { 
    box-shadow: 0 0 30px rgba(184, 144, 102, 0.5);
  }
}

@keyframes number-count {
  from { 
    transform: scale(0.8) rotateY(90deg);
    opacity: 0;
  }
  to { 
    transform: scale(1) rotateY(0deg);
    opacity: 1;
  }
}

/* Animation classes */
.animate-fade-in {
  animation: fade-in 0.8s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.animate-fade-in-left {
  animation: fade-in-left 0.8s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.animate-fade-in-right {
  animation: fade-in-right 0.8s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.animate-scale-in {
  animation: scale-in 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.animate-slide-down {
  animation: slide-down 0.6s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.animate-bounce-in {
  animation: bounce-in 0.8s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.animate-number-count {
  animation: number-count 0.5s cubic-bezier(0.4, 0, 0.2, 1) both;
}

/* Delay utilities for staggered animations */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }
.delay-700 { animation-delay: 0.7s; }
.delay-800 { animation-delay: 0.8s; }

/* Enhanced background animation */
.hero-bg-animate {
  animation: float-bg 12s ease-in-out infinite;
}

/* Countdown timer enhancements */
.countdown-container {
  animation: pulse-glow 3s ease-in-out infinite;
}

.countdown-number {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.countdown-number:hover {
  transform: scale(1.1);
}

/* Goal cards hover effects */
.goal-card {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.goal-card:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}



/* FAQ accordion smooth animations */
.faq-item {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.faq-item:hover {
  transform: translateX(5px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

/* Button hover enhancements */
.btn {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

.btn:hover::before {
  left: 100%;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

/* Smooth scroll behavior */
html {
  scroll-behavior: smooth;
}

/* Section reveal animations */
.section-reveal {
  opacity: 0;
  transform: translateY(50px);
  transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
  
.section-reveal.revealed {
  opacity: 1;
  transform: translateY(0);
}

/* Logo animations */
/* .logo-float {
  animation: float-bg 6s ease-in-out infinite;
} */

/* Gradient color definitions */
.to-muted-300 {
    --tw-gradient-to: #ffe2a4 var(--tw-gradient-to-position);
}
.from-accent-500 {
    --tw-gradient-from: #fff1e1 var(--tw-gradient-from-position);
}
.from-primary-500 {
  --tw-gradient-from: #d6bfa6 var(--tw-gradient-from-position);
}
.to-accent-500 {
    --tw-gradient-to: #b89066 var(--tw-gradient-to-position);
}

/* Hide z-1 warning for decorative shapes */
.-z-1 { z-index: -1; }
</style>
