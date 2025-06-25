<template>
  <div>
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-secondary-500 to-secondary-300 py-20">
      <div class="container-custom text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-primary-500 mb-6">
          برمجان المدينة
        </h1>
        <p class="text-xl md:text-2xl text-gray-700 mb-8 max-w-3xl mx-auto">
          انضم إلى أكبر هاكاثون في المدينة المنورة وشارك في تطوير حلول تقنية مبتكرة
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <router-link to="/register" class="btn btn-primary text-lg px-8 py-3">
            {{ $t('app.register') }}
          </router-link>
          <a href="#about" class="btn btn-outline text-lg px-8 py-3">
            تعرف على المزيد
          </a>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
      <div class="container-custom">
        <h2 class="text-3xl font-bold text-primary-500 text-center mb-12">عن الحدث</h2>
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div>
            <h3 class="text-2xl font-semibold text-primary-500 mb-4">هاكاثون برمجان المدينة</h3>
            <p class="text-gray-700 mb-6">
              حدث تقني متميز يجمع المطورين والمصممين والمبتكرين من جميع أنحاء المملكة لتطوير حلول تقنية مبتكرة 
              تخدم المجتمع وتطور الاقتصاد الرقمي.
            </p>
            <ul class="space-y-2 text-gray-700">
              <li class="flex items-center gap-2">
                <span class="w-2 h-2 bg-accent-500 rounded-full"></span>
                <span>48 ساعة من التطوير المكثف</span>
              </li>
              <li class="flex items-center gap-2">
                <span class="w-2 h-2 bg-accent-500 rounded-full"></span>
                <span>جوائز قيمة تصل إلى 100,000 ريال</span>
              </li>
              <li class="flex items-center gap-2">
                <span class="w-2 h-2 bg-accent-500 rounded-full"></span>
                <span>فرص عمل وشراكات استراتيجية</span>
              </li>
            </ul>
          </div>
          <div class="bg-secondary-100 rounded-lg p-8">
            <h4 class="text-xl font-semibold text-primary-500 mb-4">التواريخ المهمة</h4>
            <div class="space-y-4">
              <div class="flex justify-between items-center">
                <span class="font-medium">التسجيل</span>
                <span class="text-accent-500 font-semibold">15 يناير - 15 فبراير</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-medium">الحدث</span>
                <span class="text-accent-500 font-semibold">1-3 مارس 2024</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-medium">إعلان النتائج</span>
                <span class="text-accent-500 font-semibold">3 مارس 2024</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-secondary-50">
      <div class="container-custom">
        <h2 class="text-3xl font-bold text-primary-500 text-center mb-12">مجالات المسابقة</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <div v-for="category in categories" :key="category.id" class="card text-center hover:shadow-lg transition-shadow">
            <div class="w-16 h-16 bg-accent-500 rounded-full flex items-center justify-center mx-auto mb-4">
              <component :is="category.icon" class="w-8 h-8 text-white" />
            </div>
            <h3 class="text-lg font-semibold text-primary-500 mb-2">{{ category.title }}</h3>
            <p class="text-gray-600 text-sm">{{ category.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-16 bg-white">
      <div class="container-custom">
        <h2 class="text-3xl font-bold text-primary-500 text-center mb-12">الجدول الزمني</h2>
        <div class="max-w-4xl mx-auto">
          <div v-for="(event, index) in timeline" :key="event.id" class="flex items-start gap-6 mb-8">
            <div class="flex-shrink-0 w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center text-white font-bold">
              {{ index + 1 }}
            </div>
            <div class="flex-1">
              <h3 class="text-xl font-semibold text-primary-500 mb-2">{{ event.title }}</h3>
              <p class="text-gray-600 mb-2">{{ event.description }}</p>
              <p class="text-sm text-accent-500 font-medium">{{ event.date }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-secondary-50">
      <div class="container-custom">
        <h2 class="text-3xl font-bold text-primary-500 text-center mb-12">الأسئلة الشائعة</h2>
        <div class="max-w-3xl mx-auto space-y-4">
          <div v-for="faq in faqs" :key="faq.id" class="card">
            <button @click="toggleFaq(faq.id)" class="w-full text-left flex justify-between items-center">
              <h3 class="text-lg font-semibold text-primary-500">{{ faq.question }}</h3>
              <svg :class="['w-5 h-5 text-primary-500 transition-transform', { 'rotate-180': openFaq === faq.id }]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div v-if="openFaq === faq.id" class="mt-4 text-gray-700">
              {{ faq.answer }}
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-accent-500 text-white">
      <div class="container-custom text-center">
        <h2 class="text-3xl font-bold mb-4">جاهز للمشاركة؟</h2>
        <p class="text-xl mb-8 opacity-90">سجل الآن وكن جزءاً من أكبر هاكاثون في المدينة المنورة</p>
        <router-link to="/register" class="btn bg-white text-accent-500 hover:bg-gray-100 text-lg px-8 py-3">
          {{ $t('app.register') }}
        </router-link>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();
const openFaq = ref<number | null>(null);

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

const timeline = [
  {
    id: 1,
    title: 'فتح باب التسجيل',
    description: 'بدء استقبال طلبات المشاركة من المطورين والفرق',
    date: '15 يناير 2024'
  },
  {
    id: 2,
    title: 'إغلاق باب التسجيل',
    description: 'آخر موعد لتقديم طلبات المشاركة',
    date: '15 فبراير 2024'
  },
  {
    id: 3,
    title: 'إعلان المشاركين المقبولين',
    description: 'إعلان قائمة المشاركين النهائية',
    date: '20 فبراير 2024'
  },
  {
    id: 4,
    title: 'بدء الهاكاثون',
    description: 'انطلاق فعاليات الهاكاثون لمدة 48 ساعة',
    date: '1 مارس 2024'
  }
];

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
</script>

<style scoped>
.card {
  transition: all 0.3s ease;
}
</style> 