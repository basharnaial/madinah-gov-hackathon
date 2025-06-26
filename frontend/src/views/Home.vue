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
      <div class="container-custom text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-extrabold text-muted-600 text-primary-600 mb-6 drop-shadow-sm animate-fade-in">
          {{ $t('app.hero_title') }}
        </h1>
        <p class="text-xl md:text-2xl text-gray-700 mb-10 max-w-3xl mx-auto animate-fade-in delay-100">
          {{ $t('app.hero_subtitle') }}
        </p>
        <!-- Countdown Timer -->
        <div
          class="mx-auto mt-10 mb-6 max-w-3xl rounded-3xl shadow-lg flex flex-wrap justify-center items-center gap-0 bg-gradient-to-r from-accent-500 to-muted-300 p-6"
        >
          <div
            v-for="(item, idx) in countdown"
            :key="item.label"
            class="flex flex-col items-center flex-1"
            :class="idx !== 0 ? 'border-l border-dashed border-primary-600' : ''"
          >
            <span class="text-4xl md:text-5xl font-extrabold text-primary-600">{{ item.value }}</span>
            <span class="text-lg md:text-xl font-bold text-accent-500 mt-1">{{ $t(item.label) }}</span>
          </div>
        </div>
        <p class="text-center  text-primary-600 font-semibold text-sm mb-2">
          {{ $t('app.registration_closes') }} {{ $t('app.event_date') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in delay-200">


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

    <!-- Emirate logo and welcome message -->
    <div class="flex flex-col items-center mb-2 pt-6 animate-fade-in">

      <div class="gap-4 mb-2">
        <img src="/imarat-logo.png" alt="شعار إمارة المدينة" class="w-32 mb-2" />
      </div>
      

      <span class="text-accent-500 font-bold text-lg">{{ $t('app.event_sponsor') }}</span>
      <span class="text-primary-500 font-semibold">{{ $t('app.event_location') }}</span>
      <br>
      <span class="text-accent-500 font-semibold mb-4">بالتعاون مع</span>

      <img src="/UPM-logo.png" alt="شعار إمارة المدينة" class="w-32 mb-2" />

    </div>

    <!-- About Section -->
    <section id="about" class="py-16 bg-gradient-to-br from-secondary-100 to-white border-b border-gray-100">
      <div class="max-w-3xl mx-auto bg-white/80 rounded-3xl shadow-lg px-8 py-12 text-center">
        <h2 class="text-4xl font-extrabold text-primary-600 mb-4 drop-shadow-sm">{{ $t('app.about_title') }}</h2>
        <h3 class="text-2xl font-semibold text-primary-500 mb-6">{{ $t('app.about_subtitle') }}</h3>
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
    <div class="flex flex-col items-center">
            <h2 class="text-2xl font-semibold text-primary-500 mb-4">{{ $t('admin.goals_title') }}</h2>        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 justify-center">
          <!-- Goal 1 -->
          <div class="relative group cursor-pointer min-h-[110px] h-full"
               @mouseenter="activeTooltip = 0" @mouseleave="activeTooltip = null">
            <div class="bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
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
          <div class="relative group cursor-pointer min-h-[110px] h-full"
               @mouseenter="activeTooltip = 1" @mouseleave="activeTooltip = null">
            <div class="bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
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
          <div class="relative group cursor-pointer min-h-[110px] h-full"
               @mouseenter="activeTooltip = 2" @mouseleave="activeTooltip = null">
            <div class="bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
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
          <div class="relative group cursor-pointer min-h-[110px] h-full"
               @mouseenter="activeTooltip = 3" @mouseleave="activeTooltip = null">
            <div class="bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
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
          <div class="relative group cursor-pointer min-h-[110px] h-full"
               @mouseenter="activeTooltip = 4" @mouseleave="activeTooltip = null">
            <div class="bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
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
          <div class="relative group cursor-pointer min-h-[110px] h-full"
               @mouseenter="activeTooltip = 5" @mouseleave="activeTooltip = null">
            <div class="bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
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
          <div class="relative group cursor-pointer min-h-[110px] h-full"
               @mouseenter="activeTooltip = 6" @mouseleave="activeTooltip = null">
            <div class="bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
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
          <div class="relative group cursor-pointer min-h-[110px] h-full"
               @mouseenter="activeTooltip = 7" @mouseleave="activeTooltip = null">
            <div class="bg-white rounded-lg p-3 text-center shadow hover:shadow-lg transition-all border border-gray-100 flex flex-col items-center h-full">
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



    <section class="py-16 bg-secondary-50 border-b border-gray-100">
      <div class="container-custom">
        <h2 class="text-2xl md:text-3xl font-bold text-primary-500 text-center mb-8">
          {{ $t('app.target_audiences_title') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Government entities -->
          <div class="bg-secondary-50 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 p-6 flex flex-col items-center text-center">
            <BuildingOfficeIcon class="w-10 h-10 text-accent-500 mb-3" />
            <div class="font-bold text-primary-600 text-lg mb-1">{{ $t('app.target_audiences_gov') }}</div>
            <div class="text-gray-600 text-sm">{{ $t('app.target_audiences_gov_desc') }}</div>
          </div>
          <!-- Professionals and innovators -->
          <div class="bg-secondary-50 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 p-6 flex flex-col items-center text-center">
            <LightBulbIcon class="w-10 h-10 text-accent-500 mb-3" />
            <div class="font-bold text-primary-600 text-lg mb-1">{{ $t('app.target_audiences_pro') }}</div>
            <div class="text-gray-600 text-sm">{{ $t('app.target_audiences_pro_desc') }}</div>
          </div>
          <!-- Students and recent graduates -->
          <div class="bg-secondary-50 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 p-6 flex flex-col items-center text-center">
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
        <h2 class="text-3xl font-bold text-primary-600 text-center mb-12">مراحل المسابقة</h2>
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
        <h2 class="text-3xl font-bold text-primary-500 text-center mb-12">الأسئلة الشائعة</h2>
        <div class="max-w-3xl mx-auto space-y-4">
          <div v-for="faq in faqs" :key="faq.id" class="card rounded-2xl p-6 bg-white border border-gray-100 animate-fade-in delay-200">
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
        <h2 class="text-3xl font-bold mb-4 animate-fade-in">جاهز للمشاركة؟</h2>
        <p class="text-xl mb-8 opacity-90 animate-fade-in delay-100">سجل الآن وكن جزءاً من أكبر هاكاثون في المدينة المنورة</p>
        <router-link to="/register" class="btn bg-white text-accent-500 hover:bg-gray-100 text-lg px-8 py-3 shadow-lg animate-fade-in delay-200">
          {{ $t('app.register') }}
        </router-link>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, nextTick } from 'vue';
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
  { label: 'يوم', value: 0 },
  { label: 'ساعة', value: 0 },
  { label: 'دقيقة', value: 0 },
  { label: 'ثانية', value: 0 },
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
    { label: 'يوم', value: days },
    { label: 'ساعة', value: hours },
    { label: 'دقيقة', value: minutes },
    { label: 'ثانية', value: seconds },
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

const categories = [
  {
    id: 1,
    title: 'الذكاء الاصطناعي',
    description: 'تطوير حلول ذكية باستخدام تقنيات الذكاء الاصطناعي',
    icon: 'CpuChipIcon'
  },
  {
    id: 2,
    title: 'تطوير الويب',
    description: 'بناء تطبيقات ويب حديثة ومتجاوبة',
    icon: 'GlobeAltIcon'
  },
  {
    id: 3,
    title: 'إنترنت الأشياء',
    description: 'ربط الأجهزة الذكية وإنشاء شبكات ذكية',
    icon: 'WifiIcon'
  },
  {
    id: 4,
    title: 'تطوير التطبيقات',
    description: 'تصميم وتطوير تطبيقات الهاتف المحمول',
    icon: 'DevicePhoneMobileIcon'
  }
];

const goals = [
  {
    title: 'تعزيز التوجهات الاستراتيجية للتحول الرقمي',
    description: 'دعم الابتكار في الخدمات الرقمية وتحقيق بيئة رقمية متكاملة.',
    icon: 'CogIcon'
  },
  {
    title: 'تحقيق متطلبات التحول الرقمي',
    description: 'تطبيق تقنيات ناشئة وفق معايير وطنية.',
    icon: 'CheckCircleIcon'
  },
  {
    title: 'نشر ثقافة التحول الرقمي',
    description: 'تعزيز الابتكار والتواصل مع المستفيدين.',
    icon: 'LightBulbIcon'
  },
  {
    title: 'الريادة في التحول الرقمي',
    description: 'توسيع آفاق الخبراء وتطبيق الأفكار الريادية.',
    icon: 'TrophyIcon'
  },
  {
    title: 'تفعيل شراكات التحول الرقمي',
    description: 'مشاركة الجهات المحلية بما يخدم أهداف الإمارة.',
    icon: 'UserGroupIcon'
  },
  {
    title: 'تفعيل شراكة القطاع الخاص',
    description: 'تمكين المبتكرين وتحسين الأثر المجتمعي.',
    icon: 'BuildingOfficeIcon'
  },
  {
    title: 'تمكين الكفاءات الشابة',
    description: 'تعزيز ثقافة الابتكار والتواصل مع المستفيدين.',
    icon: 'UserGroupIcon'
  },
  {
    title: 'التفاعل مع المستفيدين',
    description: 'زيادة التواجد الرقمي وربطهم برواد الأعمال.',
    icon: 'ChatBubbleLeftRightIcon'
  }
];

const officialTimeline = [
  {
    title: 'الإعلان',
    date: '29 يونيو 2025',
  },
  {
    title: 'فتح التسجيل',
    date: '6 يوليو 2025',
    description: 'يُفتح التسجيل للمشاركين بحيث يتم تعبئة البيانات العامة، واختيار المسار، ورفع السيرة الذاتية، والاطلاع على الشروط العامة، والاطلاع على الشروط العامة للمشاركة.'
  },
  {
    title: 'إغلاق التسجيل',
    date: '12 يوليو 2025',
  },
  {
    title: 'فرز المتقدمين',
    date: '13 يوليو 2025',
  },
  {
    title: 'تأكيد المشاركات',
    date: '14 يوليو 2025',
  },
  {
    title: 'اليوم التعريفي',
    date: '20 يوليو 2025',
    description: 'بعد تأكيد المشاركات، يبدأ على استقبال الفرق المشاركة وتعريفهم بالشروط العامة، كما يتم توزيع الفرق وتحديد مجالات التحدي، وتقديم شرح لأدوات التنفيذ والمنصة التقنية الخاصة بالبرمجان، مما يساعد المشاركين على بداية مسارهم الجديد.'
  },
  {
    title: 'أيام البرمجان',
    date: '10–12 أغسطس 2025',
  },
  {
    title: 'التحكيم النهائي',
    date: '12 أغسطس 2025',
  },
  {
    title: 'الحفل الختامي',
    date: '13 أغسطس 2025',
  },
];

const steps = [
  {
    title: 'مرحلة استقبال الطلبات',
    subtitle: 'يبدأ المشاركون بالتقديم من خلال رفع فيديو تعريفي عن أنفسهم وفكرتهم المقترحة.',
    description: '',
  },
  {
    title: 'مرحلة التصفيات الأولى',
    subtitle: 'يتم تقييم جميع المشاركات، وتأهيل 12 فريقاً من كل مسار للانتقال إلى الجولة الثانية.',
    description: '',
  },
  {
    title: 'مرحلة ورش العمل والعروض التقديمية',
    subtitle: 'يحضر الفرق المؤهلة 3 ورش عمل متخصصة لمساعدتهم في تطوير أفكارهم، يليها إعداد عرض تقديمي مفصل عن الحلول المقترحة.',
    description: '',
  },
  {
    title: 'مرحلة التصفيات الثانية',
    subtitle: 'بعد تقديم العروض، يتم اختيار أفضل 5 فرق من كل مسار للتأهل إلى المرحلة النهائية.',
    description: '',
  },
  {
    title: 'مرحلة تطوير النماذج الأولية والعرض النهائي',
    subtitle: '',
    description: '',
  },
];

// Reveal on scroll logic
const stepsInView = ref<boolean[]>(Array(steps.length).fill(false));
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

const faqs = [
  {
    id: 1,
    question: 'من يمكنه المشاركة في الهاكاثون؟',
    answer: 'يمكن للمطورين والمصممين ورواد الأعمال من جميع الأعمار المشاركة، سواء بشكل فردي أو كفريق.'
  },
  {
    id: 2,
    question: 'ما هي متطلبات المشاركة؟',
    answer: 'يجب أن يكون عمر المشارك 16 سنة أو أكثر، وأن يكون لديه خبرة في مجال التقنية أو التصميم.'
  },
  {
    id: 3,
    question: 'هل هناك رسوم للمشاركة؟',
    answer: 'لا، المشاركة مجانية تماماً. سيتم توفير الطعام والشراب طوال فترة الهاكاثون.'
  },
  {
    id: 4,
    question: 'ما هي الجوائز المتاحة؟',
    answer: 'إجمالي الجوائز يصل إلى 100,000 ريال سعودي، بالإضافة إلى فرص عمل وشراكات استراتيجية.'
  }
];

function toggleFaq(id: number) {
  openFaq.value = openFaq.value === id ? null : id;
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
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

/* Simple fade-in animation */
@keyframes fade-in {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: none; }
}
.animate-fade-in {
  animation: fade-in 0.8s cubic-bezier(0.4,0,0.2,1) both;
}

/* Delay utilities for staggered animations */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }

/* Hide z-1 warning for decorative shapes */
.-z-1 { z-index: -1; }

@keyframes float-bg {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-20px); }
}
.hero-bg-animate {
  animation: float-bg 8s ease-in-out infinite;
}
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
</style>
