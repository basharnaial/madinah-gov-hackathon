<template>
  <div class="min-h-screen bg-gradient-to-br from-secondary-500 to-secondary-300 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div class="text-center">
        <h2 class="text-3xl font-bold text-primary-500">تسجيل دخول المدير</h2>
        <p class="mt-2 text-gray-600">أدخل بيانات الدخول الخاصة بك</p>
      </div>
      
      <form @submit.prevent="handleLogin" class="card space-y-6">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
            البريد الإلكتروني
          </label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            required
            class="input"
            :class="{ 'border-red-500': errors.email }"
            placeholder="أدخل بريدك الإلكتروني"
          />
          <p v-if="errors.email" class="mt-1 text-sm text-red-500">{{ errors.email }}</p>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
            كلمة المرور
          </label>
          <div class="relative">
            <input
              id="password"
              v-model="form.password"
              :type="showPassword ? 'text' : 'password'"
              required
              class="input pr-10"
              :class="{ 'border-red-500': errors.password }"
              placeholder="أدخل كلمة المرور"
            />
            <button
              type="button"
              @click="showPassword = !showPassword"
              class="absolute inset-y-0 left-0 pr-3 flex items-center"
            >
              <svg v-if="showPassword" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
              </svg>
              <svg v-else class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </button>
          </div>
          <p v-if="errors.password" class="mt-1 text-sm text-red-500">{{ errors.password }}</p>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember"
              v-model="form.remember"
              type="checkbox"
              class="h-4 w-4 text-accent-500 focus:ring-accent-500 border-gray-300 rounded"
            />
            <label for="remember" class="mr-2 block text-sm text-gray-700">
              تذكرني
            </label>
          </div>
        </div>

        <div>
          <button
            type="submit"
            :disabled="loading"
            class="btn btn-primary w-full"
          >
            <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ loading ? 'جاري تسجيل الدخول...' : 'تسجيل الدخول' }}
          </button>
        </div>

        <div class="text-center">
          <router-link to="/" class="text-sm text-accent-500 hover:text-accent-600">
            العودة للصفحة الرئيسية
          </router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useAdminStore } from '@/stores/admin';
import { useUIStore } from '@/stores/ui';
import { apiService } from '@/utils/api';

const router = useRouter();
const adminStore = useAdminStore();
const uiStore = useUIStore();

const form = reactive({
  email: '',
  password: '',
  remember: false
});

const errors = reactive({
  email: '',
  password: ''
});

const loading = ref(false);
const showPassword = ref(false);

function validateForm() {
  errors.email = '';
  errors.password = '';

  if (!form.email) {
    errors.email = 'البريد الإلكتروني مطلوب';
    return false;
  }

  if (!form.password) {
    errors.password = 'كلمة المرور مطلوبة';
    return false;
  }

  return true;
}

async function handleLogin() {
  if (!validateForm()) return;

  loading.value = true;
  try {
    const response = await apiService.adminLogin(form);
    if (response.success && response.data) {
      adminStore.setAdmin(response.data.admin);
      adminStore.setToken(response.data.token);
      uiStore.showAlert('success', 'تم تسجيل الدخول بنجاح');
      router.push('/admin/dashboard');
    } else {
      uiStore.showAlert('error', response.message || 'فشل في تسجيل الدخول');
    }
  } catch (error: any) {
    if (error.response?.data?.errors) {
      Object.assign(errors, error.response.data.errors);
    }
    uiStore.showAlert('error', error.response?.data?.message || 'حدث خطأ أثناء تسجيل الدخول');
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
.card {
  background: white;
  padding: 2rem;
  border-radius: 0.5rem;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}
</style> 