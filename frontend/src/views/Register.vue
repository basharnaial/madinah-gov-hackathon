<template>
  <div class="container-custom py-10 max-w-2xl mx-auto">
    <div class="card">
      <h1 class="text-2xl font-bold mb-6 text-primary-500 text-center">{{ $t('app.register') }}</h1>
      <form @submit.prevent="onSubmit" enctype="multipart/form-data" novalidate>
        <div class="grid grid-cols-1 gap-4">
          <div>
            <label class="label" for="full_name">{{ $t('form.full_name') }}</label>
            <input v-model="form.full_name" id="full_name" type="text" class="input" :class="{'input-error': errors.full_name}" :placeholder="$t('form.full_name')" required />
            <p v-if="errors.full_name" class="text-red-500 text-xs mt-1">{{ errors.full_name[0] }}</p>
          </div>
          <div>
            <label class="label" for="email">{{ $t('form.email') }}</label>
            <input v-model="form.email" id="email" type="email" class="input" :class="{'input-error': errors.email}" :placeholder="$t('form.email')" required />
            <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email[0] }}</p>
          </div>
          <div>
            <label class="label" for="phone">{{ $t('form.phone') }}</label>
            <input v-model="form.phone" id="phone" type="tel" class="input" :class="{'input-error': errors.phone}" :placeholder="$t('form.phone')" required />
            <p v-if="errors.phone" class="text-red-500 text-xs mt-1">{{ errors.phone[0] }}</p>
          </div>
          <div class="flex gap-4">
            <div class="flex-1">
              <label class="label" for="age">{{ $t('form.age') }}</label>
              <input v-model.number="form.age" id="age" type="number" min="16" max="100" class="input" :class="{'input-error': errors.age}" :placeholder="$t('form.age')" required />
              <p v-if="errors.age" class="text-red-500 text-xs mt-1">{{ errors.age[0] }}</p>
            </div>
            <div class="flex-1">
              <label class="label" for="city">{{ $t('form.city') }}</label>
              <input v-model="form.city" id="city" type="text" class="input" :class="{'input-error': errors.city}" :placeholder="$t('form.city')" required />
              <p v-if="errors.city" class="text-red-500 text-xs mt-1">{{ errors.city[0] }}</p>
            </div>
          </div>
          <div>
            <label class="label" for="field_of_interest">{{ $t('form.field_of_interest') }}</label>
            <select v-model="form.field_of_interest" id="field_of_interest" class="input" :class="{'input-error': errors.field_of_interest}" required>
              <option value="" disabled>{{ $t('form.field_of_interest') }}</option>
              <option v-for="option in fieldOptions" :key="option.value" :value="option.value">
                {{ isRTL ? option.label_ar : option.label }}
              </option>
            </select>
            <p v-if="errors.field_of_interest" class="text-red-500 text-xs mt-1">{{ errors.field_of_interest[0] }}</p>
          </div>
          <div>
            <label class="label" for="registration_type">{{ $t('form.registration_type') }}</label>
            <select v-model="form.registration_type" id="registration_type" class="input" :class="{'input-error': errors.registration_type}" required>
              <option value="" disabled>{{ $t('form.registration_type') }}</option>
              <option v-for="option in registrationTypeOptions" :key="option.value" :value="option.value">
                {{ isRTL ? option.label_ar : option.label }}
              </option>
            </select>
            <p v-if="errors.registration_type" class="text-red-500 text-xs mt-1">{{ errors.registration_type[0] }}</p>
          </div>
          <div>
            <label class="label" for="cv">{{ $t('form.cv') }}</label>
            <input @change="onFileChange" id="cv" type="file" accept="application/pdf" class="input" :class="{'input-error': errors.cv}" required />
            <p v-if="errors.cv" class="text-red-500 text-xs mt-1">{{ errors.cv[0] }}</p>
          </div>
          <div>
            <label class="label" for="project_idea">{{ $t('form.project_idea') }}</label>
            <textarea v-model="form.project_idea" id="project_idea" class="input" :placeholder="$t('form.project_idea')" rows="3"></textarea>
            <p v-if="errors.project_idea" class="text-red-500 text-xs mt-1">{{ errors.project_idea[0] }}</p>
          </div>
          <div class="flex items-center gap-2">
            <input v-model="form.terms_accepted" id="terms" type="checkbox" class="h-4 w-4 text-primary-500 border-gray-300 rounded" required />
            <label for="terms" class="text-sm">{{ $t('form.terms') }}</label>
          </div>
          <button type="submit" class="btn btn-primary w-full mt-4" :disabled="loading">
            <span v-if="loading" class="animate-spin mr-2"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg></span>
            {{ $t('form.submit') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';
import { useLanguageStore } from '@/stores/language';
import { apiService } from '@/utils/api';
import { FIELD_OF_INTEREST_OPTIONS, REGISTRATION_TYPE_OPTIONS } from '@/types';
import { useUIStore } from '@/stores/ui';

const router = useRouter();
const { t } = useI18n();
const languageStore = useLanguageStore();
const isRTL = computed(() => languageStore.isRTL);
const uiStore = useUIStore();

const fieldOptions = FIELD_OF_INTEREST_OPTIONS;
const registrationTypeOptions = REGISTRATION_TYPE_OPTIONS;

const form = reactive({
  full_name: '',
  email: '',
  phone: '',
  age: 18,
  city: '',
  field_of_interest: '',
  registration_type: '',
  cv: null as File | null,
  project_idea: '',
  terms_accepted: false,
});

const errors = reactive<Record<string, string[]>>({});
const loading = ref(false);

function onFileChange(e: Event) {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    form.cv = target.files[0];
  } else {
    form.cv = null;
  }
}

async function onSubmit() {
  errors.full_name = [];
  errors.email = [];
  errors.phone = [];
  errors.age = [];
  errors.city = [];
  errors.field_of_interest = [];
  errors.registration_type = [];
  errors.cv = [];
  errors.project_idea = [];
  errors.terms_accepted = [];

  // Frontend validation
  if (!form.full_name) errors.full_name.push(t('form.required'));
  if (!form.email) errors.email.push(t('form.required'));
  if (!form.phone) errors.phone.push(t('form.required'));
  if (!form.age || form.age < 16 || form.age > 100) errors.age.push(t('form.required'));
  if (!form.city) errors.city.push(t('form.required'));
  if (!form.field_of_interest) errors.field_of_interest.push(t('form.required'));
  if (!form.registration_type) errors.registration_type.push(t('form.required'));
  if (!form.cv) errors.cv.push(t('form.required'));
  if (!form.terms_accepted) errors.terms_accepted.push(t('form.required'));

  if (Object.values(errors).some(arr => arr.length > 0)) {
    uiStore.showAlert('error', t('form.error'));
    return;
  }

  loading.value = true;
  try {
    const formData = new FormData();
    Object.entries(form).forEach(([key, value]) => {
      if (key === 'cv' && value) {
        formData.append('cv', value as File);
      } else {
        formData.append(key, value as any);
      }
    });
    const response = await apiService.registerParticipant(formData);
    if (response.success) {
      uiStore.showAlert('success', t('form.success'));
      router.push('/thank-you');
    } else {
      uiStore.showAlert('error', response.message || t('form.error'));
      if (response.error) errors.general = [response.error];
    }
  } catch (error: any) {
    if (error.response?.data?.errors) {
      Object.assign(errors, error.response.data.errors);
    }
    uiStore.showAlert('error', error.response?.data?.message || t('form.error'));
  } finally {
    loading.value = false;
  }
}
</script> 