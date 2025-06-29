<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
      <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
          <div class="flex items-center gap-6">
            <h1 class="text-2xl font-bold text-primary-500">لوحة تحكم المدير</h1>
            <nav class="flex items-center gap-4">
              <router-link 
                to="/admin/dashboard" 
                class="text-sm font-medium transition-colors hover:text-primary-600"
                :class="$route.name === 'AdminDashboard' ? 'text-primary-600' : 'text-gray-600'"
              >
                المشاركين
              </router-link>
              <router-link 
                to="/admin/timeline" 
                class="text-sm font-medium transition-colors hover:text-primary-600"
                :class="$route.name === 'TimelineManagement' ? 'text-primary-600' : 'text-gray-600'"
              >
                إدارة الجدول الزمني
              </router-link>
            </nav>
          </div>
          <div class="flex items-center gap-4">
            <button @click="$router.push('/admin/dashboard')" class="text-gray-600 hover:text-primary-600 text-sm">
              العودة للوحة التحكم
            </button>
          </div>
        </div>
      </div>
    </header>
    
    <div class="container mx-auto px-4 py-8">
      <!-- Header -->
      <div class="mb-8 flex justify-between items-center">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">{{ $t('admin.timeline_management') }}</h1>
          <p class="text-gray-600 mt-2">{{ $t('admin.timeline_management_desc') }}</p>
        </div>
        <button
          @click="openCreateModal"
          class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center gap-2"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          {{ $t('admin.add_step') }}
        </button>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="text-center py-12">
        <div class="inline-flex items-center space-x-2">
          <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-600"></div>
          <span class="text-gray-600">{{ $t('admin.loading') }}</span>
        </div>
      </div>

      <!-- Timeline Steps Table -->
      <div v-else-if="steps.length > 0" class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ $t('admin.order') }}
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ $t('admin.title') }}
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ $t('admin.date') }}
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ $t('admin.status') }}
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ $t('admin.actions') }}
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="step in sortedSteps" :key="step.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-100 text-primary-800 font-medium">
                    {{ step.order }}
                  </span>
                </td>
                <td class="px-6 py-4">
                  <div class="text-sm font-medium text-gray-900">
                    {{ languageStore.currentLanguage === 'ar' ? step.title_ar : step.title_en }}
                  </div>
                  <div class="text-sm text-gray-500 mt-1">
                    {{ languageStore.currentLanguage === 'ar' ? step.subtitle_ar : step.subtitle_en }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  <div v-if="step.step_date" class="flex flex-col">
                    <span class="font-medium">{{ formatDate(step.step_date) }}</span>
                    <span class="text-xs text-gray-500">{{ formatHijriDate(step.step_date) }} هـ</span>
                  </div>
                  <span v-else class="text-gray-400">{{ $t('admin.no_date') }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span 
                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                    :class="step.is_active 
                      ? 'bg-green-100 text-green-800' 
                      : 'bg-red-100 text-red-800'"
                  >
                    {{ step.is_active ? $t('admin.active') : $t('admin.inactive') }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                  <button
                    @click="editStep(step)"
                    class="text-indigo-600 hover:text-indigo-900 transition-colors"
                  >
                    {{ $t('admin.edit') }}
                  </button>
                  <button
                    @click="confirmDelete(step)"
                    class="text-red-600 hover:text-red-900 transition-colors"
                  >
                    {{ $t('admin.delete') }}
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-12">
        <div class="text-gray-500">
          <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
          </svg>
          <p class="text-lg font-medium">{{ $t('admin.no_steps') }}</p>
          <p class="text-sm mt-2">{{ $t('admin.no_steps_desc') }}</p>
        </div>
      </div>
    </div>

    <!-- Create/Edit Modal -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b px-6 py-4">
          <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">
              {{ editingStep ? $t('admin.edit_step') : $t('admin.create_step') }}
            </h3>
            <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
        </div>

        <form @submit.prevent="saveStep" class="p-6 space-y-6">
          <!-- Order -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('admin.order') }}</label>
            <input
              v-model.number="form.order"
              type="number"
              min="1"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
            >
          </div>

          <!-- Arabic Title -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('admin.title_ar') }}</label>
            <input
              v-model="form.title_ar"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
              dir="rtl"
            >
          </div>

          <!-- English Title -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('admin.title_en') }}</label>
            <input
              v-model="form.title_en"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
            >
          </div>

          <!-- Arabic Subtitle -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('admin.subtitle_ar') }}</label>
            <textarea
              v-model="form.subtitle_ar"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
              dir="rtl"
            ></textarea>
          </div>

          <!-- English Subtitle -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('admin.subtitle_en') }}</label>
            <textarea
              v-model="form.subtitle_en"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
            ></textarea>
          </div>

          <!-- Date -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('admin.date') }}</label>
            <input
              v-model="form.step_date"
              type="date"
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
            >
          </div>

          <!-- Active Status -->
          <div class="flex items-center">
            <input
              v-model="form.is_active"
              id="is_active"
              type="checkbox"
              class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
            >
            <label for="is_active" class="ml-2 block text-sm text-gray-900">
              {{ $t('admin.is_active') }}
            </label>
          </div>

          <!-- Form Actions -->
          <div class="flex justify-end space-x-3 pt-6 border-t">
            <button
              type="button"
              @click="closeModal"
              class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
              {{ $t('admin.cancel') }}
            </button>
            <button
              type="submit"
              :disabled="saving"
              class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 disabled:opacity-50"
            >
              {{ saving ? $t('admin.saving') : $t('admin.save') }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg max-w-md w-full p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $t('admin.confirm_delete') }}</h3>
        <p class="text-gray-600 mb-6">{{ $t('admin.confirm_delete_step') }}</p>
        
        <div class="flex justify-end space-x-3">
          <button
            @click="showDeleteModal = false"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50"
          >
            {{ $t('admin.cancel') }}
          </button>
          <button
            @click="deleteStep"
            :disabled="deleting"
            class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 disabled:opacity-50"
          >
            {{ deleting ? $t('admin.deleting') : $t('admin.delete') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { useLanguageStore } from '@/stores/language';
import { apiService } from '@/utils/api';
import { formatDateArabic, formatDateEnglish, formatHijriDate } from '@/utils/dateUtils';
import type { TimelineStep } from '@/types';

const languageStore = useLanguageStore();

// State
const steps = ref<TimelineStep[]>([]);
const loading = ref(true);
const showModal = ref(false);
const showDeleteModal = ref(false);
const saving = ref(false);
const deleting = ref(false);
const editingStep = ref<TimelineStep | null>(null);
const stepToDelete = ref<TimelineStep | null>(null);

// Form
const form = ref({
  order: 1,
  title_ar: '',
  title_en: '',
  subtitle_ar: '',
  subtitle_en: '',
  description_ar: '',
  description_en: '',
  step_date: '',
  is_active: true
});

// Computed
const sortedSteps = computed(() => {
  return [...steps.value].sort((a, b) => a.order - b.order);
});

// Methods
function formatDate(dateString: string): string {
  return languageStore.currentLanguage === 'ar' 
    ? formatDateArabic(dateString)
    : formatDateEnglish(dateString);
}

async function fetchSteps() {
  try {
    loading.value = true;
    const response = await apiService.getAdminTimelineSteps();
    if (response.success && response.data) {
      steps.value = response.data;
    }
  } catch (error) {
    console.error('Failed to fetch timeline steps:', error);
  } finally {
    loading.value = false;
  }
}

function openCreateModal() {
  editingStep.value = null;
  resetForm();
  showModal.value = true;
}

function editStep(step: TimelineStep) {
  editingStep.value = step;
  form.value = {
    order: step.order,
    title_ar: step.title_ar,
    title_en: step.title_en,
    subtitle_ar: step.subtitle_ar || '',
    subtitle_en: step.subtitle_en || '',
    description_ar: step.description_ar || '',
    description_en: step.description_en || '',
    step_date: step.step_date || '',
    is_active: step.is_active
  };
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
  editingStep.value = null;
  resetForm();
}

function resetForm() {
  form.value = {
    order: steps.value.length + 1,
    title_ar: '',
    title_en: '',
    subtitle_ar: '',
    subtitle_en: '',
    description_ar: '',
    description_en: '',
    step_date: '',
    is_active: true
  };
}

async function saveStep() {
  try {
    saving.value = true;
    
    const stepData = {
      ...form.value,
      step_date: form.value.step_date || null
    };
    
    if (editingStep.value) {
      await apiService.updateTimelineStep(editingStep.value.id, stepData);
    } else {
      await apiService.createTimelineStep(stepData);
    }
    
    await fetchSteps();
    closeModal();
  } catch (error) {
    console.error('Failed to save timeline step:', error);
  } finally {
    saving.value = false;
  }
}

function confirmDelete(step: TimelineStep) {
  stepToDelete.value = step;
  showDeleteModal.value = true;
}

async function deleteStep() {
  if (!stepToDelete.value) return;
  
  try {
    deleting.value = true;
    await apiService.deleteTimelineStep(stepToDelete.value.id);
    await fetchSteps();
    showDeleteModal.value = false;
    stepToDelete.value = null;
  } catch (error) {
    console.error('Failed to delete timeline step:', error);
  } finally {
    deleting.value = false;
  }
}

// Lifecycle
onMounted(() => {
  fetchSteps();
});
</script> 