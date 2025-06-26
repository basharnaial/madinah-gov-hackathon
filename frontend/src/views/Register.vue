<template>
  <div class="min-h-screen bg-gradient-to-br from-secondary-100 to-white py-12 px-4">
    <div class="container-custom max-w-3xl mx-auto">
      <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-600 to-accent-500 px-8 py-6 text-center text-white">
          <h1 class="text-3xl font-bold mb-2">{{ $t('app.register') }}</h1>
          <p class="text-primary-100 opacity-90">انضم إلى هاكاثون المدينة المنورة</p>
        </div>
        
        <!-- Form Content -->
        <div class="px-8 py-8">
          <form @submit.prevent="onSubmit" enctype="multipart/form-data" novalidate class="space-y-6">
            
            <!-- Personal Information Section -->
            <div class="form-section">
              <h2 class="section-title">
                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                المعلومات الشخصية
              </h2>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                  <label class="form-label" for="full_name">
                    <span class="required-asterisk">*</span>
                    {{ $t('form.full_name') }}
                  </label>
                  <input 
                    v-model="form.full_name" 
                    id="full_name" 
                    type="text" 
                    class="form-input" 
                    :class="{'form-input-error': errors.full_name}" 
                    :placeholder="$t('form.full_name')" 
                    required 
                  />
                  <p v-if="errors.full_name" class="form-error">{{ errors.full_name[0] }}</p>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="email">
                    <span class="required-asterisk">*</span>
                    {{ $t('form.email') }}
                  </label>
                  <input 
                    v-model="form.email" 
                    id="email" 
                    type="email" 
                    class="form-input" 
                    :class="{'form-input-error': errors.email}" 
                    :placeholder="$t('form.email')" 
                    required 
                  />
                  <p v-if="errors.email" class="form-error">{{ errors.email[0] }}</p>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="phone">
                    <span class="required-asterisk">*</span>
                    {{ $t('form.phone') }}
                  </label>
                  <input 
                    v-model="form.phone" 
                    id="phone" 
                    type="tel" 
                    class="form-input" 
                    :class="{'form-input-error': errors.phone}" 
                    :placeholder="$t('form.phone')" 
                    required 
                  />
                  <p v-if="errors.phone" class="form-error">{{ errors.phone[0] }}</p>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="age">
                    <span class="required-asterisk">*</span>
                    {{ $t('form.age') }}
                  </label>
                  <input 
                    v-model.number="form.age" 
                    id="age" 
                    type="number" 
                    min="16" 
                    max="100" 
                    class="form-input" 
                    :class="{'form-input-error': errors.age}" 
                    :placeholder="$t('form.age')" 
                    required 
                  />
                  <p v-if="errors.age" class="form-error">{{ errors.age[0] }}</p>
                </div>
                
                <div class="form-group md:col-span-2">
                  <label class="form-label" for="city">
                    <span class="required-asterisk">*</span>
                    {{ $t('form.city') }}
                  </label>
                  <input 
                    v-model="form.city" 
                    id="city" 
                    type="text" 
                    class="form-input" 
                    :class="{'form-input-error': errors.city}" 
                    :placeholder="$t('form.city')" 
                    required 
                  />
                  <p v-if="errors.city" class="form-error">{{ errors.city[0] }}</p>
                </div>
              </div>
            </div>
            
            <!-- Registration Details Section -->
            <div class="form-section">
              <h2 class="section-title">
                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                تفاصيل التسجيل
              </h2>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                  <label class="form-label" for="field_of_interest">
                    <span class="required-asterisk">*</span>
                    {{ $t('form.field_of_interest') }}
                  </label>
                  <select 
                    v-model="form.field_of_interest" 
                    id="field_of_interest" 
                    class="form-select" 
                    :class="{'form-input-error': errors.field_of_interest}" 
                    required
                  >
                    <option value="" disabled>{{ $t('form.field_of_interest') }}</option>
                    <option v-for="option in fieldOptions" :key="option.value" :value="option.value">
                      {{ isRTL ? option.label_ar : option.label }}
                    </option>
                  </select>
                  <p v-if="errors.field_of_interest" class="form-error">{{ errors.field_of_interest[0] }}</p>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="registration_type">
                    <span class="required-asterisk">*</span>
                    {{ $t('form.registration_type') }}
                  </label>
                  <select 
                    v-model="form.registration_type" 
                    id="registration_type" 
                    class="form-select" 
                    :class="{'form-input-error': errors.registration_type}" 
                    required
                  >
                    <option value="" disabled>{{ $t('form.registration_type') }}</option>
                    <option v-for="option in registrationTypeOptions" :key="option.value" :value="option.value">
                      {{ isRTL ? option.label_ar : option.label }}
                    </option>
                  </select>
                  <p v-if="errors.registration_type" class="form-error">{{ errors.registration_type[0] }}</p>
                </div>
              </div>
            </div>
            
            <!-- Team Members Section -->
            <div v-if="form.registration_type === 'Team' || form.registration_type === 'Organization'" class="form-section team-section">
              <div class="team-header">
                <div class="flex items-center gap-3 mb-4">
                  <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-bold text-primary-700">
                      {{ form.registration_type === 'Team' ? 'أعضاء الفريق' : 'أعضاء المنظمة' }}
                    </h3>
                    <p class="text-sm text-gray-600">
                      {{ form.registration_type === 'Team' 
                        ? 'أضف أسماء أعضاء الفريق الإضافيين (اختياري - يمكنك إضافة حتى 10 أعضاء)' 
                        : 'أضف أسماء أعضاء المنظمة الإضافيين (اختياري - يمكنك إضافة حتى 15 عضو)' 
                      }}
                    </p>
                  </div>
                </div>
              </div>
              
              <div class="team-members-list">
                <div v-for="(member, index) in teamMembers" :key="index" class="team-member-item">
                  <div class="member-number">
                    {{ index + 1 }}
                  </div>
                  <input 
                    v-model="teamMembers[index]" 
                    type="text" 
                    :placeholder="`اسم ${form.registration_type === 'Team' ? 'عضو الفريق' : 'عضو المنظمة'} ${index + 1}`"
                    class="form-input flex-1"
                    maxlength="100"
                  />
                  <button 
                    @click="removeMember(index)" 
                    type="button" 
                    class="remove-member-btn"
                    :disabled="teamMembers.length === 1"
                    :title="teamMembers.length === 1 ? 'يجب أن يكون هناك عضو واحد على الأقل' : 'حذف العضو'"
                  >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </div>
              
              <div class="team-controls">
                <button 
                  @click="addMember" 
                  type="button" 
                  class="add-member-btn"
                  :disabled="teamMembers.length >= getMaxMembers()"
                >
                  <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                  </svg>
                  إضافة {{ form.registration_type === 'Team' ? 'عضو فريق' : 'عضو منظمة' }} جديد
                </button>
                <span class="member-counter">
                  {{ teamMembers.length }} / {{ getMaxMembers() }} {{ form.registration_type === 'Team' ? 'أعضاء' : 'أعضاء' }}
                </span>
              </div>
              
              <!-- Quick add buttons -->
              <div v-if="teamMembers.length === 1" class="quick-add-section">
                <p class="quick-add-label">إضافة سريعة:</p>
                <div class="quick-add-buttons">
                  <button 
                    @click="setTeamSize(3)" 
                    type="button" 
                    class="quick-add-btn"
                  >
                    {{ form.registration_type === 'Team' ? 'فريق من 3' : 'منظمة من 3' }}
                  </button>
                  <button 
                    @click="setTeamSize(5)" 
                    type="button" 
                    class="quick-add-btn"
                  >
                    {{ form.registration_type === 'Team' ? 'فريق من 5' : 'منظمة من 5' }}
                  </button>
                  <button 
                    @click="setTeamSize(7)" 
                    type="button" 
                    class="quick-add-btn"
                  >
                    {{ form.registration_type === 'Team' ? 'فريق من 7' : 'منظمة من 7' }}
                  </button>
                </div>
              </div>
            </div>
            
            <!-- Additional Information Section -->
            <div class="form-section">
              <h2 class="section-title">
                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                معلومات إضافية
              </h2>
              
              <div class="space-y-6">
                <div class="form-group">
                  <label class="form-label" for="cv">
                    <span class="required-asterisk">*</span>
                    {{ $t('form.cv') }}
                  </label>
                  <div class="file-upload-wrapper">
                    <input 
                      @change="onFileChange" 
                      id="cv" 
                      type="file" 
                      accept="application/pdf" 
                      class="file-input" 
                      :class="{'form-input-error': errors.cv}" 
                      required 
                    />
                    <div class="file-upload-label" :class="{ 'file-selected': form.cv }">
                      <svg v-if="!form.cv" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                      </svg>
                      <svg v-else class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <div class="text-center">
                        <span v-if="!form.cv" class="text-sm text-gray-600">اختر ملف السيرة الذاتية (PDF)</span>
                        <div v-else>
                          <span class="text-sm text-green-700 font-semibold">{{ form.cv.name }}</span>
                          <p class="text-xs text-gray-500 mt-1">{{ formatFileSize(form.cv.size) }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <p v-if="errors.cv" class="form-error">{{ errors.cv[0] }}</p>
                </div>
                
                <div class="form-group">
                  <label class="form-label" for="project_idea">
                    {{ $t('form.project_idea') }}
                  </label>
                  <textarea 
                    v-model="form.project_idea" 
                    id="project_idea" 
                    class="form-textarea" 
                    :placeholder="$t('form.project_idea')" 
                    rows="4"
                  ></textarea>
                  <p v-if="errors.project_idea" class="form-error">{{ errors.project_idea[0] }}</p>
                </div>
              </div>
            </div>
            
            <!-- Terms and Submit -->
            <div class="form-section">
              <div class="terms-checkbox">
                <input 
                  v-model="form.terms_accepted" 
                  id="terms" 
                  type="checkbox" 
                  class="checkbox-input" 
                  required 
                />
                <label for="terms" class="checkbox-label">
                  <span class="required-asterisk">*</span>
                  {{ $t('form.terms') }}
                </label>
              </div>
              
              <button type="submit" class="submit-btn" :disabled="loading">
                <span v-if="loading" class="loading-spinner">
                  <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                  </svg>
                </span>
                {{ loading ? 'جاري الإرسال...' : $t('form.submit') }}
              </button>
            </div>
            
          </form>
        </div>
      </div>
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

// Team members array (only used when registration_type is 'Team' or 'Organization')
const teamMembers = ref<string[]>(['']);

function getMaxMembers(): number {
  return form.registration_type === 'Team' ? 10 : 15;
}

function addMember() {
  if (teamMembers.value.length < getMaxMembers()) {
    teamMembers.value.push('');
  }
}

function removeMember(index: number) {
  if (teamMembers.value.length > 1) {
    teamMembers.value.splice(index, 1);
  }
}

function setTeamSize(size: number) {
  const maxMembers = getMaxMembers();
  const targetSize = Math.min(size, maxMembers);
  
  if (targetSize > teamMembers.value.length) {
    // Add empty members
    const membersToAdd = targetSize - teamMembers.value.length;
    for (let i = 0; i < membersToAdd; i++) {
      teamMembers.value.push('');
    }
  } else if (targetSize < teamMembers.value.length) {
    // Remove excess members (keeping filled ones if possible)
    teamMembers.value = teamMembers.value.slice(0, targetSize);
  }
}

function onFileChange(e: Event) {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    form.cv = target.files[0];
  } else {
    form.cv = null;
  }
}

function formatFileSize(bytes: number): string {
  if (bytes === 0) return '0 Bytes';
  const k = 1024;
  const sizes = ['Bytes', 'KB', 'MB', 'GB'];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
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
    
    // Add team members if registration type is Team
    if (form.registration_type === 'Team' || form.registration_type === 'Organization') {
      const validTeamMembers = teamMembers.value.filter(name => name.trim() !== '');
      validTeamMembers.forEach((memberName, index) => {
        formData.append(`team_members[${index}]`, memberName.trim());
      });
    }
    
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

<style scoped>
/* Form Sections */
.form-section {
  @apply bg-gray-50/50 rounded-xl p-6 border border-gray-100;
}

.section-title {
  @apply flex items-center gap-3 text-xl font-bold text-primary-500 mb-6 pb-3 border-b border-gray-200;
}

/* Form Groups */
.form-group {
  @apply space-y-2;
}

/* Labels */
.form-label {
  @apply block text-sm font-semibold text-accent-500 mb-2;
}

.required-asterisk {
  @apply text-red-500 font-bold mr-1;
}

/* Input Fields */
.form-input {
  @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-gray-900 placeholder-gray-400;
}

.form-input:focus {
  @apply shadow-lg transform scale-[1.02];
}

.form-input-error {
  @apply border-red-500 focus:ring-red-500 focus:border-red-500 bg-red-50;
}

/* Select Fields */
.form-select {
  @apply form-input appearance-none bg-white cursor-pointer;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
  background-position: right 0.75rem center;
  background-repeat: no-repeat;
  background-size: 1.5em 1.5em;
  padding-right: 2.5rem;
}

.form-select:focus {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23d6bfa6' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
}

/* Textarea */
.form-textarea {
  @apply form-input resize-y min-h-[100px];
}

/* Error Messages */
.form-error {
  @apply text-red-500 text-sm mt-1 flex items-center gap-1;
}

.form-error::before {
  content: "⚠";
  @apply text-red-500;
}

/* File Upload */
.file-upload-wrapper {
  @apply relative;
}

.file-input {
  @apply absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10;
}

.file-upload-label {
  @apply flex items-center justify-center gap-3 w-full px-4 py-6 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 transition-all duration-200 cursor-pointer;
}

.file-upload-label.file-selected {
  @apply border-green-400 bg-green-50 border-solid;
}

.file-upload-wrapper:hover .file-upload-label {
  @apply border-blue-400 bg-blue-50;
}

.file-upload-wrapper:hover .file-upload-label.file-selected {
  @apply border-green-500 bg-green-100;
}

.file-input:focus + .file-upload-label {
  @apply ring-2 ring-blue-500 border-blue-500;
}

/* Team Section */
.team-section {
  @apply bg-gradient-to-br from-blue-50 to-amber-50 border-blue-200;
}

.team-header {
  @apply mb-6;
}

.team-members-list {
  @apply space-y-4 mb-6;
}

.team-member-item {
  @apply flex items-center gap-3 p-3 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200;
}

.member-number {
  @apply flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-amber-500 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-md;
}

.remove-member-btn {
  @apply flex-shrink-0 w-10 h-10 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-full flex items-center justify-center transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed;
}

.remove-member-btn:hover:not(:disabled) {
  @apply scale-110 shadow-md;
}

/* Team Controls */
.team-controls {
  @apply flex items-center justify-between flex-wrap gap-4 p-4 bg-white/70 rounded-lg border border-blue-200;
}

.add-member-btn {
  @apply flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed font-medium;
}

.add-member-btn:hover:not(:disabled) {
  @apply shadow-lg transform scale-105;
}

.member-counter {
  @apply text-sm text-gray-600 font-medium bg-white px-3 py-1 rounded-full border border-gray-200;
}

/* Quick Add Section */
.quick-add-section {
  @apply mt-4 pt-4 border-t border-blue-200;
}

.quick-add-label {
  @apply text-sm text-gray-600 mb-3 font-medium;
}

.quick-add-buttons {
  @apply flex gap-2 flex-wrap;
}

.quick-add-btn {
  @apply text-sm px-3 py-2 bg-white text-blue-700 rounded-lg border border-blue-200 hover:bg-blue-100 hover:border-blue-300 transition-all duration-200 font-medium;
}

.quick-add-btn:hover {
  @apply shadow-md transform scale-105;
}

/* Checkbox */
.terms-checkbox {
  @apply flex items-start gap-3 p-4 bg-amber-50 rounded-lg border border-amber-200 mb-6;
}

.checkbox-input {
  @apply w-5 h-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 mt-0.5 flex-shrink-0;
}

.checkbox-label {
  @apply text-sm text-gray-700 font-medium leading-relaxed cursor-pointer;
}

/* Submit Button */
.submit-btn {
  @apply w-full bg-gradient-to-r from-blue-600 to-amber-500 text-white font-bold py-4 px-8 rounded-xl hover:from-blue-700 hover:to-amber-600 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 text-lg shadow-lg;
}

.submit-btn:hover:not(:disabled) {
  @apply shadow-xl transform scale-[1.02];
}

.loading-spinner {
  @apply inline-flex items-center mr-3;
}

/* Animations */
@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.form-section {
  animation: slideIn 0.5s ease-out;
}

.form-section:nth-child(2) { animation-delay: 0.1s; }
.form-section:nth-child(3) { animation-delay: 0.2s; }
.form-section:nth-child(4) { animation-delay: 0.3s; }
.form-section:nth-child(5) { animation-delay: 0.4s; }

/* Responsive Design */
@media (max-width: 768px) {
  .team-controls {
    @apply flex-col items-stretch;
  }
  
  .member-counter {
    @apply text-center;
  }
  
  .quick-add-buttons {
    @apply justify-center;
  }
}

/* Focus States */
.form-input:focus,
.form-select:focus,
.form-textarea:focus {
  @apply outline-none ring-2 ring-accent-500 border-accent-200;
}

/* Hover Effects */
.form-group:hover .form-label {
  @apply text-accent-500;
}

.team-member-item:hover {
  @apply border-blue-200 bg-blue-50/30;
}

/* Success States */
.form-input:valid:not(:placeholder-shown) {
  @apply border-green-300 bg-green-50/30;
}

/* Custom Scrollbar for Textarea */
.form-textarea::-webkit-scrollbar {
  @apply w-2;
}

.form-textarea::-webkit-scrollbar-track {
  @apply bg-gray-100 rounded;
}

.form-textarea::-webkit-scrollbar-thumb {
  @apply bg-gray-300 rounded hover:bg-gray-400;
}
</style> 