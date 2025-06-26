<template>
  <div>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-secondary-500 to-secondary-300 py-24 md:py-32 overflow-hidden">
      <!-- Emara Pattern كخلفية كاملة للهيرو -->
      <img
        src="/Emara-bg.svg"
        alt="Emara Pattern"
        class="absolute inset-0 w-full h-full object-cover opacity-70 z-0 pointer-events-none select-none hero-bg-animate"
        style="object-fit: cover;"
      />
      <div class="container-custom text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-extrabold text-primary-600 mb-6 drop-shadow-sm animate-fade-in">
          {{ $t('app.hero_title') }}
        </h1>
        <p class="text-xl md:text-2xl text-gray-700 mb-10 max-w-3xl mx-auto animate-fade-in delay-100">
          {{ $t('app.hero_subtitle') }}
        </p>
        <!-- Countdown Timer -->
        <div
          class="mx-auto mt-10 mb-6 max-w-3xl rounded-3xl shadow-lg flex flex-wrap justify-center items-center gap-0 bg-gradient-to-r from-[#b99166] to-[#aaccbd] p-6"
          style="background: linear-gradient(90deg, #b99166 0%, #e8d9bb 100%);"
        >
          <div
            v-for="(item, idx) in countdown"
            :key="item.label"
            class="flex flex-col items-center flex-1"
            :style="{ borderLeft: idx !== 0 ? '1px dashed #24784d' : 'none' }"
          >
            <span class="text-4xl md:text-5xl font-extrabold text-[#24784d]">{{ item.value }}</span>
            <span class="text-lg md:text-xl font-bold text-[#b99166] mt-1">{{ $t(item.label) }}</span>
          </div>
        </div>
        <p class="text-center  text-[#24784d] font-semibold text-sm mb-2">
          {{ $t('app.registration_closes') }} {{ $t('app.event_date') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in delay-200">
          <router-link
            to="#"
            @click.prevent="openRegisterModal"
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

    <!-- Modal التسجيل -->
    <div
      v-if="showRegisterModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div
        class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative"
        style="max-height: 90vh; overflow-y: auto;"
      >
        <button @click="closeRegisterModal" class="absolute top-4 left-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-4 text-primary-500">{{ $t('app.register') }}</h2>
        <form @submit.prevent="onSubmit" enctype="multipart/form-data" novalidate>
          <div class="grid grid-cols-1 gap-3">
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

    <!-- شعار الإمارة وعبارة ترحيبية -->
    <div class="flex flex-col items-center mb-2 pt-6 animate-fade-in">
      <img src="/logo.svg" alt="شعار إمارة المدينة" class="w-20 mb-2" />
      <span class="text-accent-500 font-bold text-lg">{{ $t('app.event_sponsor') }}</span>
      <span class="text-primary-500 font-semibold">{{ $t('app.event_location') }}</span>
    </div>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white border-b border-gray-100">
      <div class="container-custom">
        <h2 class="text-3xl font-bold text-primary-500 text-center mb-12">{{ $t('app.about_title') }}</h2>
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div>
            <h3 class="text-2xl font-semibold text-primary-500 mb-4">{{ $t('app.about_subtitle') }}</h3>
            <p class="text-gray-700 mb-6 leading-relaxed">
              {{ $t('app.about_description') }}
            </p>
            <ul class="space-y-2 text-gray-700">
              <li class="flex items-center gap-2">
                <span class="w-2 h-2 bg-accent-500 rounded-full"></span>
                <span>{{ $t('app.feature1') }}</span>
              </li>
              <li class="flex items-center gap-2">
                <span class="w-2 h-2 bg-accent-500 rounded-full"></span>
                <span>{{ $t('app.feature2') }}</span>
              </li>
              <li class="flex items-center gap-2">
                <span class="w-2 h-2 bg-accent-500 rounded-full"></span>
                <span>{{ $t('app.feature3') }}</span>
              </li>
            </ul>
          </div>
          <div class="">
            <h2 class="text-2xl font-semibold text-primary-500 mb-4">{{ $t('app.goals_title') }}</h2>        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 justify-center">
          <!-- هدف 1 -->
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
          <!-- هدف 2 -->
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
          <!-- هدف 3 -->
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
          <!-- هدف 4 -->
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
          <!-- هدف 5 -->
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
          <!-- هدف 6 -->
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
          <!-- هدف 7 -->
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
          <!-- هدف 8 -->
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

        </div>
      </div>
    </section>

  
    <section class="py-16 bg-secondary-50 border-b border-gray-100">
      <div class="container-custom">
        <h2 class="text-2xl md:text-3xl font-bold text-primary-500 text-center mb-8">
          {{ $t('app.target_audiences_title') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- الجهات الحكومية -->
          <div class="bg-secondary-50 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 p-6 flex flex-col items-center text-center">
            <BuildingOfficeIcon class="w-10 h-10 text-accent-500 mb-3" />
            <div class="font-bold text-primary-600 text-lg mb-1">{{ $t('app.target_audiences_gov') }}</div>
            <div class="text-gray-600 text-sm">{{ $t('app.target_audiences_gov_desc') }}</div>
          </div>
          <!-- المهنيين والمبتكرين -->
          <div class="bg-secondary-50 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 p-6 flex flex-col items-center text-center">
            <LightBulbIcon class="w-10 h-10 text-accent-500 mb-3" />
            <div class="font-bold text-primary-600 text-lg mb-1">{{ $t('app.target_audiences_pro') }}</div>
            <div class="text-gray-600 text-sm">{{ $t('app.target_audiences_pro_desc') }}</div>
          </div>
          <!-- الطلبة وحديثي التخرج -->
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
        <h2 class="text-3xl font-bold text-[#24784d] text-center mb-12">مراحل المسابقة</h2>
        <div class="relative flex flex-col items-center">
          <!-- الخط العمودي في المنتصف -->
          <div class="absolute left-1/2 top-0 w-1 bg-gradient-to-b from-[#b99166] to-[#24784d] h-full -translate-x-1/2 z-0"></div>
          <div
            v-for="(step, idx) in steps"
            :key="idx"
            :class="[ 'relative flex w-full mb-16', idx % 2 === 0 ? 'flex-row-reverse' : 'flex-row' ]"
            :ref="el => setStepRef(el, idx)"
            :data-idx="idx"
          >
            <!-- الكارد: تناوب يمين/يسار -->
            <div class="w-1/2 flex" :class="idx % 2 === 0 ? 'justify-end pr-8' : 'justify-start pl-8'">
              <div
                class="bg-[#e8d9bb] rounded-xl shadow-lg p-6 text-right max-w-md transition-all duration-700"
                :class="[
                  idx % 2 === 0 ? 'mr-auto border-l-8 border-[#b99166]' : 'ml-auto border-r-8 border-[#24784d]',
                  stepsInView[idx] ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'
                ]"
              >
                <div class="text-lg font-bold text-[#24784d] mb-2">{{ step.title }}</div>
                <div v-if="step.subtitle" class="text-sm font-semibold text-[#b99166] mb-2">{{ step.subtitle }}</div>
                <div v-if="step.description" class="text-gray-700 text-sm leading-relaxed">{{ step.description }}</div>
              </div>
            </div>
            <!-- الدائرة في منتصف الخط -->
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10 transition-all duration-700"
              :class="stepsInView[idx] ? 'opacity-100 scale-100' : 'opacity-0 scale-75'"
            >
              <div class="w-12 h-12 rounded-full bg-white border-4 border-[#24784d] flex items-center justify-center shadow-lg ring-4 ring-[#aaccbd] animate-pulse">
                <span class="text-2xl font-bold text-[#24784d]">{{ idx + 1 }}</span>
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
import { ref, onMounted, onUnmounted, nextTick, reactive, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';
import { useLanguageStore } from '@/stores/language';
import { apiService } from '@/utils/api';
import { FIELD_OF_INTEREST_OPTIONS, REGISTRATION_TYPE_OPTIONS } from '@/types';
import { useUIStore } from '@/stores/ui';
import { CogIcon, CheckCircleIcon, LightBulbIcon, TrophyIcon, UserGroupIcon, ChatBubbleLeftRightIcon, BuildingOfficeIcon } from '@heroicons/vue/24/solid';
import type { ComponentPublicInstance } from 'vue';

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
      closeRegisterModal();
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

const showRegisterModal = ref(false);

function openRegisterModal() {
  showRegisterModal.value = true;
}

function closeRegisterModal() {
  showRegisterModal.value = false;
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
</style> 