<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
      <div class="container-custom py-4">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-bold text-primary-500">لوحة تحكم المدير</h1>
          <div class="flex items-center gap-4">
            <span class="text-gray-600">مرحباً، {{ adminStore.admin?.name }}</span>
            <button @click="handleLogout" class="btn btn-outline text-sm">
              تسجيل الخروج
            </button>
          </div>
        </div>
      </div>
    </header>

    <div class="container-custom py-8">
      <!-- Statistics Cards -->
      <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="card bg-gradient-to-r from-accent-500 to-accent-600 text-white">
          <div class="flex items-center">
            <div class="p-3 bg-white bg-opacity-20 rounded-lg">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <div class="mr-4">
              <p class="text-sm opacity-90">إجمالي المشاركين</p>
              <p class="text-2xl font-bold">{{ statistics.total_participants }}</p>
            </div>
          </div>
        </div>

        <div class="card bg-gradient-to-r from-primary-500 to-primary-600 text-white">
          <div class="flex items-center">
            <div class="p-3 bg-white bg-opacity-20 rounded-lg">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="mr-4">
              <p class="text-sm opacity-90">مقبول</p>
              <p class="text-2xl font-bold">{{ statistics.approved_participants }}</p>
            </div>
          </div>
        </div>

        <div class="card bg-gradient-to-r from-yellow-500 to-yellow-600 text-white">
          <div class="flex items-center">
            <div class="p-3 bg-white bg-opacity-20 rounded-lg">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="mr-4">
              <p class="text-sm opacity-90">في الانتظار</p>
              <p class="text-2xl font-bold">{{ statistics.pending_participants }}</p>
            </div>
          </div>
        </div>

        <div class="card bg-gradient-to-r from-red-500 to-red-600 text-white">
          <div class="flex items-center">
            <div class="p-3 bg-white bg-opacity-20 rounded-lg">
              <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </div>
            <div class="mr-4">
              <p class="text-sm opacity-90">مرفوض</p>
              <p class="text-2xl font-bold">{{ statistics.rejected_participants }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters and Search -->
      <div class="card mb-6">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <input
              v-model="filters.search"
              type="text"
              placeholder="البحث بالاسم أو البريد الإلكتروني..."
              class="input w-full"
            />
          </div>
          <div class="flex gap-2">
            <select v-model="filters.status" class="input">
              <option value="">جميع الحالات</option>
              <option value="Pending">في الانتظار</option>
              <option value="Approved">مقبول</option>
              <option value="Rejected">مرفوض</option>
            </select>
            <select v-model="filters.field" class="input">
              <option value="">جميع المجالات</option>
              <option value="ai">الذكاء الاصطناعي</option>
              <option value="web">تطوير الويب</option>
              <option value="iot">إنترنت الأشياء</option>
              <option value="mobile">تطوير التطبيقات</option>
            </select>
            <button @click="exportParticipants" class="btn btn-accent">
              <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              تصدير
            </button>
          </div>
        </div>
      </div>

      <!-- Participants Table -->
      <div class="card overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  المشارك
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  البريد الإلكتروني
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  المدينة
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  المجال
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  الحالة
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  التاريخ
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                  الإجراءات
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="participant in filteredParticipants" :key="participant.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <div class="h-10 w-10 rounded-full bg-primary-500 flex items-center justify-center text-white font-semibold">
                        {{ participant.full_name.charAt(0) }}
                      </div>
                    </div>
                    <div class="mr-4">
                      <div class="text-sm font-medium text-gray-900">{{ participant.full_name }}</div>
                      <div class="text-sm text-gray-500">{{ participant.phone }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ participant.email }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ participant.city }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ getFieldName(participant.field_of_interest) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="getStatusClass(participant.status)" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                    {{ getStatusName(participant.status) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  {{ formatDate(participant.created_at) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <div class="flex gap-2">
                    <button @click="viewParticipant(participant)" class="text-accent-500 hover:text-accent-700">
                      عرض
                    </button>
                    <button v-if="participant.status === 'Pending'" @click="updateStatus(participant.id, 'Approved')" class="text-green-500 hover:text-green-700">
                      قبول
                    </button>
                    <button v-if="participant.status === 'Pending'" @click="updateStatus(participant.id, 'Rejected')" class="text-red-500 hover:text-red-700">
                      رفض
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
          <div class="flex-1 flex justify-between sm:hidden">
            <button @click="previousPage" :disabled="currentPage === 1" class="btn btn-outline">
              السابق
            </button>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="btn btn-outline">
              التالي
            </button>
          </div>
          <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                عرض <span class="font-medium">{{ (currentPage - 1) * perPage + 1 }}</span> إلى 
                <span class="font-medium">{{ Math.min(currentPage * perPage, totalParticipants) }}</span> من 
                <span class="font-medium">{{ totalParticipants }}</span> نتيجة
              </p>
            </div>
            <div>
              <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                <button @click="previousPage" :disabled="currentPage === 1" class="btn btn-outline">
                  السابق
                </button>
                <button @click="nextPage" :disabled="currentPage === totalPages" class="btn btn-outline">
                  التالي
                </button>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Participant Modal -->
    <div v-if="selectedParticipant" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <h3 class="text-lg font-medium text-gray-900 mb-4">تفاصيل المشارك</h3>
          <div class="space-y-3">
            <div>
              <label class="block text-sm font-medium text-gray-700">الاسم الكامل</label>
              <p class="text-sm text-gray-900">{{ selectedParticipant.full_name }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
              <p class="text-sm text-gray-900">{{ selectedParticipant.email }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">الهاتف</label>
              <p class="text-sm text-gray-900">{{ selectedParticipant.phone }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">العمر</label>
              <p class="text-sm text-gray-900">{{ selectedParticipant.age }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">المدينة</label>
              <p class="text-sm text-gray-900">{{ selectedParticipant.city }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">مجال الاهتمام</label>
              <p class="text-sm text-gray-900">{{ getFieldName(selectedParticipant.field_of_interest) }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">فكرة المشروع</label>
              <p class="text-sm text-gray-900">{{ selectedParticipant.project_idea }}</p>
            </div>
          </div>
          <div class="mt-6 flex justify-end">
            <button @click="selectedParticipant = null" class="btn btn-outline">
              إغلاق
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useAdminStore } from '@/stores/admin';
import { useUIStore } from '@/stores/ui';
import { apiService } from '@/utils/api';
import type { Participant } from '@/types';

const router = useRouter();
const adminStore = useAdminStore();
const uiStore = useUIStore();

const participants = ref<Participant[]>([]);
const selectedParticipant = ref<Participant | null>(null);
const loading = ref(false);
const currentPage = ref(1);
const perPage = ref(10);
const totalParticipants = ref(0);

const filters = reactive({
  search: '',
  status: '',
  field: ''
});

const statistics = reactive({
  total_participants: 0,
  approved_participants: 0,
  pending_participants: 0,
  rejected_participants: 0
});

const filteredParticipants = computed(() => {
  let filtered = participants.value;

  if (filters.search) {
    const search = filters.search.toLowerCase();
    filtered = filtered.filter(p => 
      p.full_name.toLowerCase().includes(search) || 
      p.email.toLowerCase().includes(search)
    );
  }

  if (filters.status) {
    filtered = filtered.filter(p => p.status === filters.status);
  }

  if (filters.field) {
    filtered = filtered.filter(p => p.field_of_interest === filters.field);
  }

  return filtered;
});

const totalPages = computed(() => Math.ceil(totalParticipants.value / perPage.value));

onMounted(() => {
  loadParticipants();
  loadStatistics();
});

async function loadParticipants() {
  loading.value = true;
  try {
    const response = await apiService.getParticipants();
    if (response.success) {
      participants.value = response.data;
      totalParticipants.value = response.data.length;
    }
  } catch (error: any) {
    uiStore.showAlert('error', 'فشل في تحميل المشاركين');
  } finally {
    loading.value = false;
  }
}

async function loadStatistics() {
  try {
    const response = await apiService.getStatistics();
    if (response.success) {
      statistics.total_participants = response.data?.total_participants || 0;
      statistics.approved_participants = response.data?.approved_participants || 0;
      statistics.pending_participants = response.data?.pending_participants || 0;
      statistics.rejected_participants = response.data?.rejected_participants || 0;
    }
  } catch (error: any) {
    console.error('Failed to load statistics:', error);
  }
}

async function updateStatus(participantId: number, status: string) {
  try {
    const response = await apiService.updateParticipantStatus(participantId, status);
    if (response.success) {
      uiStore.showAlert('success', 'تم تحديث الحالة بنجاح');
      loadParticipants();
      loadStatistics();
    }
  } catch (error: any) {
    uiStore.showAlert('error', 'فشل في تحديث الحالة');
  }
}

async function exportParticipants() {
  try {
    const response = await apiService.exportParticipants();
    if (response.success) {
      // Handle file download
      const link = document.createElement('a');
      link.href = response.data.download_url;
      link.download = 'participants.xlsx';
      link.click();
      uiStore.showAlert('success', 'تم تصدير البيانات بنجاح');
    }
  } catch (error: any) {
    uiStore.showAlert('error', 'فشل في تصدير البيانات');
  }
}

function viewParticipant(participant: Participant) {
  selectedParticipant.value = participant;
}

function getStatusName(status: string) {
  const statusMap: Record<string, string> = {
    Pending: 'في الانتظار',
    Approved: 'مقبول',
    Rejected: 'مرفوض'
  };
  return statusMap[status] || status;
}

function getStatusClass(status: string) {
  const classMap: Record<string, string> = {
    Pending: 'bg-yellow-100 text-yellow-800',
    Approved: 'bg-green-100 text-green-800',
    Rejected: 'bg-red-100 text-red-800'
  };
  return classMap[status] || 'bg-gray-100 text-gray-800';
}

function getFieldName(field: string) {
  const fieldMap: Record<string, string> = {
    ai: 'الذكاء الاصطناعي',
    web: 'تطوير الويب',
    iot: 'إنترنت الأشياء',
    mobile: 'تطوير التطبيقات'
  };
  return fieldMap[field] || field;
}

function formatDate(date: string) {
  return new Date(date).toLocaleDateString('ar-SA');
}

function previousPage() {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
}

function nextPage() {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
}

function handleLogout() {
  adminStore.logout();
  router.push('/admin/login');
}
</script>

<style scoped>
.card {
  background: white;
  border-radius: 0.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
}
</style> 