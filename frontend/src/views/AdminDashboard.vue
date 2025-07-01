<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
      <div class="container-custom py-4">
        <div class="flex justify-between items-center">
          <div class="flex items-center gap-6">
            <h1 class="text-2xl font-bold text-primary-500">لوحة تحكم الادارة</h1>
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
            <span class="text-gray-600">مرحباً، {{ adminStore.admin?.name }}</span>
            <button @click="handleLogout" class="btn btn-outline text-sm">
              تسجيل الخروج
            </button>
          </div>
        </div>
      </div>
    </header>

    <div class="container-custom py-8">
      <!-- Advanced Analytics Dashboard -->
      <div class="mb-10">
        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6 mb-8">
          <!-- Total Participants -->
          <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-indigo-100 text-sm font-medium">إجمالي المشاركين</p>
                <p class="text-3xl font-bold">{{ totalParticipantsKPI }}</p>
                <p class="text-indigo-200 text-xs mt-1">مقدمي الطلبات</p>
              </div>
              <div class="p-3 bg-white bg-opacity-20 rounded-full">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
            </div>
          </div>
          <!-- Conversion Rate -->
          <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-emerald-100 text-sm font-medium">معدل القبول</p>
                <p class="text-3xl font-bold">{{ conversionRate }}%</p>
                <p class="text-emerald-200 text-xs mt-1">من إجمالي المشاركين</p>
              </div>
              <div class="p-3 bg-white bg-opacity-20 rounded-full">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Average Age -->
          <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-blue-100 text-sm font-medium">متوسط العمر</p>
                <p class="text-3xl font-bold">{{ averageAge }}</p>
                <p class="text-blue-200 text-xs mt-1">سنة</p>
              </div>
              <div class="p-3 bg-white bg-opacity-20 rounded-full">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Team Percentage -->
          <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-purple-100 text-sm font-medium">نسبة الفرق</p>
                <p class="text-3xl font-bold">{{ teamPercentage }}%</p>
                <p class="text-purple-200 text-xs mt-1">من المشاركين</p>
              </div>
              <div class="p-3 bg-white bg-opacity-20 rounded-full">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Evaluation Efficiency -->
          <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-orange-100 text-sm font-medium">معدل التقييم</p>
                <p class="text-3xl font-bold">{{ evaluationEfficiency }}%</p>
                <p class="text-orange-200 text-xs mt-1">من المراجعات مكتملة</p>
              </div>
              <div class="p-3 bg-white bg-opacity-20 rounded-full">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
          <!-- Status Distribution Chart -->
          <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-bold text-gray-800">توزيع الحالات</h3>
              <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </div>
            </div>
                         <div class="h-64 flex items-center justify-center relative">
               <div v-if="loading" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75 rounded-lg">
                 <div class="loading-shimmer w-full h-full rounded-lg"></div>
               </div>
               <div v-else-if="!hasStatusData" class="text-center py-8 text-gray-500">
                 <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                 </svg>
                 <p class="text-lg font-medium">لا توجد بيانات</p>
                 <p class="text-sm text-gray-400">لا توجد إحصائيات حالة للعرض</p>
               </div>
               <canvas v-else ref="statusChartRef" width="300" height="300" class="chart-container"></canvas>
             </div>
          </div>

          <!-- Field Distribution Chart -->
          <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-bold text-gray-800">توزيع المجالات</h3>
              <div class="p-2 bg-green-100 rounded-lg">
                <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
              </div>
            </div>
                         <div class="h-64 relative">
               <div v-if="loading" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75 rounded-lg">
                 <div class="loading-shimmer w-full h-full rounded-lg"></div>
               </div>
               <div v-else-if="!hasFieldData" class="h-64 flex items-center justify-center text-gray-500">
                 <div class="text-center">
                   <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                   </svg>
                   <p class="text-lg font-medium">لا توجد بيانات</p>
                   <p class="text-sm text-gray-400">لا توجد مجالات للعرض</p>
                 </div>
               </div>
               <canvas v-else ref="fieldChartRef" width="400" height="300" class="chart-container"></canvas>
             </div>
          </div>

          <!-- Registration Trend Chart -->
          <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 lg:col-span-2 xl:col-span-1">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-bold text-gray-800">اتجاه التسجيلات</h3>
              <div class="p-2 bg-purple-100 rounded-lg">
                <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                </svg>
              </div>
            </div>
                         <div class="h-64 relative">
               <div v-if="loading" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75 rounded-lg">
                 <div class="loading-shimmer w-full h-full rounded-lg"></div>
               </div>
               <div v-else-if="!hasTrendData" class="h-64 flex items-center justify-center text-gray-500">
                 <div class="text-center">
                   <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                   </svg>
                   <p class="text-lg font-medium">لا توجد بيانات</p>
                   <p class="text-sm text-gray-400">لا توجد تسجيلات للعرض</p>
                 </div>
               </div>
               <canvas v-else ref="trendChartRef" width="400" height="300" class="chart-container"></canvas>
             </div>
          </div>
        </div>

        <!-- City Stats and Performance Metrics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <!-- Top Cities -->
          <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-bold text-gray-800">أكثر المدن مشاركة</h3>
              <div class="p-2 bg-amber-100 rounded-lg">
                <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
            </div>
            <div class="space-y-4" v-if="topCities.length > 0">
              <div v-for="(city, index) in topCities" :key="index" class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold text-white"
                       :class="getCityRankColor(index)">
                    {{ index + 1 }}
                  </div>
                  <span class="font-medium text-gray-700">{{ city.name }}</span>
                </div>
                <div class="flex items-center gap-2">
                  <span class="text-lg font-bold text-gray-800">{{ city.count }}</span>
                  <div class="w-20 bg-gray-200 rounded-full h-2">
                    <div class="h-2 rounded-full transition-all duration-300"
                         :class="getCityBarColor(index)"
                         :style="{ width: `${(city.count / topCities[0]?.count) * 100}%` }">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-else class="text-center py-8 text-gray-500">
              <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <p class="text-lg font-medium">لا توجد مشاركات</p>
              <p class="text-sm text-gray-400">لا توجد بيانات للمدن حتى الآن</p>
            </div>
          </div>

          <!-- Performance Insights -->
          <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-lg font-bold text-gray-800">نظرة على الأداء</h3>
              <div class="p-2 bg-indigo-100 rounded-lg">
                <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </div>
            </div>
            <div class="space-y-4">
              <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-lg border border-green-200">
                <div class="flex items-center gap-3">
                  <div class="p-2 bg-green-500 rounded-full">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-green-700 font-medium">معدل النمو اليومي</p>
                    <p class="text-xl font-bold text-green-800" v-if="dailyGrowthRate > 0">+{{ dailyGrowthRate }}%</p>
                    <p class="text-xl font-bold text-gray-500" v-else>لا توجد بيانات كافية</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-lg border border-blue-200">
                <div class="flex items-center gap-3">
                  <div class="p-2 bg-blue-500 rounded-full">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-blue-700 font-medium">متوسط وقت المراجعة</p>
                    <p class="text-xl font-bold text-blue-800" v-if="averageReviewTime > 0">{{ averageReviewTime }} ساعة</p>
                    <p class="text-xl font-bold text-gray-500" v-else>لا توجد تقييمات</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-4 rounded-lg border border-purple-200" v-if="mostPopularField">
                <div class="flex items-center gap-3">
                  <div class="p-2 bg-purple-500 rounded-full">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-purple-700 font-medium">المجال الأكثر شعبية</p>
                    <p class="text-lg font-bold text-purple-800">{{ mostPopularField.name }}</p>
                    <p class="text-xs text-purple-600">{{ mostPopularField.count }} مشارك</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-gradient-to-r from-gray-50 to-slate-50 p-4 rounded-lg border border-gray-200" v-else>
                <div class="flex items-center gap-3">
                  <div class="p-2 bg-gray-500 rounded-full">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-700 font-medium">المجال الأكثر شعبية</p>
                    <p class="text-lg font-bold text-gray-800">لا توجد مشاركات</p>
                  </div>
                </div>
              </div>
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
            <select v-model="filters.registration_type" class="input">
              <option value="">جميع الأنواع</option>
              <option value="Individual">فردي</option>
              <option value="Team">فريق</option>
              <option value="Organization">منظمة</option>
            </select>
            <select v-model="filters.field" class="input">
              <option value="">جميع المجالات</option>
              <option value="SmartMonitoring">المتابعة الذكية للخدمات والمرافق</option>
              <option value="InteractiveTourism">إثراء تجربة الزائر</option>
              <option value="SmartMobility">النقل الذكي والتنقل المستدام</option>
              <option value="DigitalHealthcare">الرعاية الصحية الرقمية</option>
              <option value="EnvironmentalTech">التقنية البيئية</option>
              <option value="SmartInfrastructure">البنى التحتية الذكية</option>
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
              <!-- Loading State -->
              <tr v-if="loading" v-for="i in perPage" :key="'loading-' + i">
                <td colspan="6" class="px-6 py-4 whitespace-nowrap">
                  <div class="animate-pulse flex space-x-4">
                    <div class="rounded-full bg-gray-300 h-10 w-10"></div>
                    <div class="flex-1 space-y-2 py-1">
                      <div class="h-4 bg-gray-300 rounded w-3/4"></div>
                      <div class="h-4 bg-gray-300 rounded w-1/2"></div>
                    </div>
                  </div>
                </td>
              </tr>
              
              <!-- No Data State -->
              <tr v-else-if="!loading && filteredParticipants.length === 0">
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                  <div class="flex flex-col items-center">
                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <p class="text-lg font-medium mb-2">لا يوجد مشاركين</p>
                    <p class="text-sm">لم يتم العثور على أي مشاركين بالفلاتر المحددة</p>
                  </div>
                </td>
              </tr>
              
              <!-- Data Rows -->
              <tr v-else v-for="participant in filteredParticipants" :key="participant.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <div class="h-10 w-10 rounded-full bg-primary-500 flex items-center justify-center text-white font-semibold">
                        {{ participant.full_name.charAt(0) }}
                      </div>
                    </div>
                    <div class="mr-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{ participant.full_name }} - {{ getRegistrationTypeName(participant.registration_type) }}
                      </div>
                      <div class="text-sm text-gray-500">{{ participant.phone }}</div>
                      <div class="text-sm text-gray-500">{{ participant.email }}</div>
                    </div>
                  </div>
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
                    <button v-if="participant.status === 'Pending'" @click="openEvaluationModal(participant)" class="text-green-500 hover:text-green-700">
                      قبول
                    </button>
                    <button v-if="participant.status === 'Pending'" @click="rejectParticipant(participant.id)" class="text-red-500 hover:text-red-700">
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
                عرض <span class="font-medium">{{ totalParticipants > 0 ? (currentPage - 1) * perPage + 1 : 0 }}</span> إلى 
                <span class="font-medium">{{ Math.min(currentPage * perPage, totalParticipants) }}</span> من 
                <span class="font-medium">{{ totalParticipants }}</span> نتيجة
              </p>
            </div>
            <div>
              <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px gap-2">
                <button 
                  @click="previousPage" 
                  :disabled="currentPage === 1 || loading" 
                  class="btn btn-outline"
                  :class="{ 'opacity-50 cursor-not-allowed': currentPage === 1 || loading }"
                >
                  السابق
                </button>
                <span class="flex items-center px-3 py-2 text-sm text-gray-500">
                  صفحة {{ currentPage }} من {{ totalPages }}
                </span>
                <button 
                  @click="nextPage" 
                  :disabled="currentPage === totalPages || loading" 
                  class="btn btn-outline"
                  :class="{ 'opacity-50 cursor-not-allowed': currentPage === totalPages || loading }"
                >
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
            <div v-if="(selectedParticipant.registration_type === 'Team' || selectedParticipant.registration_type === 'Organization') && selectedParticipant.team_members && selectedParticipant.team_members.length > 0">
              <label class="block text-sm font-medium text-gray-700">
                {{ selectedParticipant.registration_type === 'Team' ? 'أعضاء الفريق' : 'أعضاء المنظمة' }}
              </label>
              <div class="mt-2 space-y-2">
                <div v-for="(member, index) in selectedParticipant.team_members" :key="member.id" class="flex items-center gap-2 bg-gray-50 rounded-lg p-2">
                  <div class="w-6 h-6 rounded-full bg-accent-500 flex items-center justify-center text-white text-xs font-semibold">
                    {{ index + 1 }}
                  </div>
                  <span class="text-sm text-gray-900">{{ member.name }}</span>
                </div>
              </div>
            </div>
            <div v-if="selectedParticipant.cv_path">
              <label class="block text-sm font-medium text-gray-700">المرفق (السيرة الذاتية)</label>
              <button @click="downloadCv(selectedParticipant.id)" class="text-accent-500 underline">
                تحميل المرفق (السيرة الذاتية)
              </button>
            </div>
            <div v-if="selectedParticipant.evaluation">
              <label class="block text-sm font-medium text-gray-700">نتيجة التحكيم</label>
              <div class="bg-gray-50 rounded-lg p-3 mt-2">
                <div class="flex items-center gap-2 mb-2">
                  <span class="text-sm font-medium text-gray-700">النسبة:</span>
                  <span class="text-lg font-bold text-primary-600">{{ selectedParticipant.evaluation.score }}%</span>
                </div>
                <div>
                  <span class="text-sm font-medium text-gray-700">الوصف:</span>
                  <p class="text-sm text-gray-900 mt-1">{{ selectedParticipant.evaluation.description }}</p>
                </div>
              </div>
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

    <!-- Evaluation Modal -->
    <div v-if="showEvaluationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <h3 class="text-lg font-medium text-gray-900 mb-4">تحكيم المشارك</h3>
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">اسم المشارك</label>
              <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">{{ evaluationParticipant?.full_name }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">النسبة المئوية *</label>
              <input
                v-model.number="evaluationForm.score"
                type="number"
                min="0"
                max="100"
                step="0.01"
                class="input w-full"
                placeholder="أدخل النسبة من 0 إلى 100"
                :class="{ 'border-red-500': evaluationErrors.score }"
              />
              <p v-if="evaluationErrors.score" class="text-red-500 text-xs mt-1">{{ evaluationErrors.score }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">وصف التحكيم *</label>
              <textarea
                v-model="evaluationForm.description"
                rows="4"
                class="input w-full resize-none"
                placeholder="اكتب وصف مفصل عن تقييم المشارك..."
                :class="{ 'border-red-500': evaluationErrors.description }"
              ></textarea>
              <p v-if="evaluationErrors.description" class="text-red-500 text-xs mt-1">{{ evaluationErrors.description }}</p>
            </div>
          </div>
          <div class="mt-6 flex justify-end gap-2">
            <button @click="closeEvaluationModal" class="btn btn-outline">
              إلغاء
            </button>
            <button @click="submitEvaluation" :disabled="evaluationLoading" class="btn btn-primary">
              <span v-if="evaluationLoading">جاري القبول...</span>
              <span v-else>قبول المشارك</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, computed, onMounted, watch, nextTick } from 'vue';
import { useRouter } from 'vue-router';
import { useAdminStore } from '@/stores/admin';
import { useUIStore } from '@/stores/ui';
import { apiService } from '@/utils/api';
import type { Participant } from '@/types';
import { Chart, type ChartConfiguration, registerables } from 'chart.js';

// Register all Chart.js components
Chart.register(...registerables);

// Test Chart.js availability
console.log('Chart.js loaded:', Chart);
console.log('Chart.js version:', Chart.version);

const router = useRouter();
const adminStore = useAdminStore();
const uiStore = useUIStore();

const participants = ref<Participant[]>([]);
const selectedParticipant = ref<Participant | null>(null);
const loading = ref(false);
const currentPage = ref(1);
const perPage = ref(10);
const totalParticipants = ref(0);

// Chart refs
const statusChartRef = ref<HTMLCanvasElement>();
const fieldChartRef = ref<HTMLCanvasElement>();
const trendChartRef = ref<HTMLCanvasElement>();

// Chart instances
let statusChart: Chart<'doughnut'> | null = null;
let fieldChart: Chart<'bar'> | null = null;
let trendChart: Chart<'line'> | null = null;

// Evaluation Modal
const showEvaluationModal = ref(false);
const evaluationParticipant = ref<Participant | null>(null);
const evaluationLoading = ref(false);
const evaluationForm = reactive({
  score: 0,
  description: ''
});
const evaluationErrors = reactive({
  score: '',
  description: ''
});

const filters = reactive({
  search: '',
  status: '',
  registration_type: '',
  field: ''
});

const statistics = reactive({
  total_participants: 0,
  approved_participants: 0,
  pending_participants: 0,
  rejected_participants: 0
});

// Advanced analytics data
const analyticsData = reactive({
  cityStats: new Map<string, number>(),
  fieldStats: new Map<string, number>(),
  dailyRegistrations: new Map<string, number>(),
  ageStats: [] as number[],
  teamStats: { teams: 0, individuals: 0, organizations: 0 },
  cvStats: { withCv: 0, withoutCv: 0 },
  evaluationStats: { evaluated: 0, pending: 0 }
});

const filteredParticipants = computed(() => {
  // Since we're now filtering on the backend, just return participants
  return participants.value.filter(p => p && p.full_name);
});

const totalPages = computed(() => Math.ceil(totalParticipants.value / perPage.value));

// Advanced Analytics Computed Properties - 100% Real Data Only
const conversionRate = computed(() => {
  const total = statistics.total_participants;
  const approved = statistics.approved_participants;
  if (!total || total === 0) return 0;
  return Math.round((approved / total) * 100);
});

const averageAge = computed(() => {
  if (analyticsData.ageStats.length === 0) return 0;
  const sum = analyticsData.ageStats.reduce((a, b) => a + b, 0);
  return Math.round(sum / analyticsData.ageStats.length);
});

const teamPercentage = computed(() => {
  const total = statistics.total_participants;
  if (!total || total === 0) return 0;
  const teamCount = analyticsData.teamStats.teams + analyticsData.teamStats.organizations;
  return Math.round((teamCount / total) * 100);
});

const evaluationEfficiency = computed(() => {
  const total = statistics.total_participants;
  if (!total || total === 0) return 0;
  const evaluated = analyticsData.evaluationStats.evaluated;
  return Math.round((evaluated / total) * 100);
});

const totalParticipantsKPI = computed(() => {
  return statistics.total_participants || 0;
});

const topCities = computed(() => {
  return Array.from(analyticsData.cityStats.entries())
    .map(([name, count]) => ({ name, count }))
    .sort((a, b) => b.count - a.count)
    .slice(0, 5);
});

// Chart data availability checks
const hasStatusData = computed(() => {
  return statistics.total_participants > 0;
});

const hasFieldData = computed(() => {
  return analyticsData.fieldStats.size > 0;
});

const hasTrendData = computed(() => {
  return Array.from(analyticsData.dailyRegistrations.values()).some(count => count > 0);
});

const mostPopularField = computed(() => {
  const entries = Array.from(analyticsData.fieldStats.entries());
  if (entries.length === 0) return null;
  
  const [field, count] = entries.reduce((a, b) => a[1] > b[1] ? a : b);
  return { 
    name: getFieldName(field), 
    count 
  };
});

const dailyGrowthRate = computed(() => {
  const registrations = Array.from(analyticsData.dailyRegistrations.values());
  if (registrations.length < 2) return 0;
  
  const recent = registrations.slice(-7); // Last 7 days
  const older = registrations.slice(-14, -7); // Previous 7 days
  
  if (recent.length === 0 || older.length === 0) return 0;
  
  const recentAvg = recent.reduce((a, b) => a + b, 0) / recent.length;
  const olderAvg = older.reduce((a, b) => a + b, 0) / older.length;
  
  if (olderAvg === 0) return 0;
  return Math.round(((recentAvg - olderAvg) / olderAvg) * 100);
});

const averageReviewTime = computed(() => {
  // Real calculation based on evaluation timestamps
  const evaluatedParticipants = participants.value.filter(p => p.evaluation && p.updated_at && p.created_at);
  if (evaluatedParticipants.length === 0) return 0;
  
  const totalHours = evaluatedParticipants.reduce((sum, participant) => {
    const created = new Date(participant.created_at!);
    const updated = new Date(participant.updated_at!);
    const hoursDiff = (updated.getTime() - created.getTime()) / (1000 * 60 * 60);
    return sum + hoursDiff;
  }, 0);
  
  return Math.round(totalHours / evaluatedParticipants.length);
});

// Helper Functions
function getCityRankColor(index: number): string {
  const colors = [
    'bg-yellow-500',    // Gold
    'bg-gray-400',      // Silver  
    'bg-yellow-600',    // Bronze
    'bg-blue-500',      // 4th
    'bg-purple-500'     // 5th
  ];
  return colors[index] || 'bg-gray-500';
}

function getCityBarColor(index: number): string {
  const colors = [
    'bg-yellow-500',    // Gold
    'bg-gray-400',      // Silver
    'bg-yellow-600',    // Bronze
    'bg-blue-500',      // 4th
    'bg-purple-500'     // 5th
  ];
  return colors[index] || 'bg-gray-500';
}

// Analytics Functions - Real Data Only
function updateAnalyticsData() {
  // Reset analytics data
  analyticsData.cityStats.clear();
  analyticsData.fieldStats.clear();
  analyticsData.dailyRegistrations.clear();
  analyticsData.ageStats.length = 0;
  analyticsData.teamStats = { teams: 0, individuals: 0, organizations: 0 };
  analyticsData.cvStats = { withCv: 0, withoutCv: 0 };
  analyticsData.evaluationStats = { evaluated: 0, pending: 0 };

  // Only process real participants data - NO DEMO DATA
  participants.value.forEach(participant => {
    // City stats
    const city = participant.city || 'غير محدد';
    analyticsData.cityStats.set(city, (analyticsData.cityStats.get(city) || 0) + 1);

    // Field stats
    const field = participant.field_of_interest || 'Other';
    analyticsData.fieldStats.set(field, (analyticsData.fieldStats.get(field) || 0) + 1);

    // Age stats
    if (participant.age) {
      analyticsData.ageStats.push(participant.age);
    }

    // Team stats
    switch (participant.registration_type) {
      case 'Team':
        analyticsData.teamStats.teams++;
        break;
      case 'Organization':
        analyticsData.teamStats.organizations++;
        break;
      default:
        analyticsData.teamStats.individuals++;
    }

    // CV stats
    if (participant.cv_path) {
      analyticsData.cvStats.withCv++;
    } else {
      analyticsData.cvStats.withoutCv++;
    }

    // Evaluation stats
    if (participant.evaluation) {
      analyticsData.evaluationStats.evaluated++;
    } else {
      analyticsData.evaluationStats.pending++;
    }

    // Daily registrations
    const date = participant.created_at ? new Date(participant.created_at).toISOString().split('T')[0] : new Date().toISOString().split('T')[0];
    analyticsData.dailyRegistrations.set(date, (analyticsData.dailyRegistrations.get(date) || 0) + 1);
  });
}

// Chart Creation Functions
function createStatusChart() {
  try {
    if (!statusChartRef.value) {
      console.log('Status chart ref not found');
      return;
    }

    const ctx = statusChartRef.value.getContext('2d');
    if (!ctx) {
      console.log('Canvas context not available');
      return;
    }

    // Destroy existing chart
    if (statusChart) {
      statusChart.destroy();
    }

    // Use real data only - no demo data
    const approvedCount = statistics.approved_participants || 0;
    const pendingCount = statistics.pending_participants || 0;
    const rejectedCount = statistics.rejected_participants || 0;

    // Don't create chart if no data
    if (approvedCount === 0 && pendingCount === 0 && rejectedCount === 0) {
      console.log('No data for status chart, skipping creation');
      return;
    }

    console.log('Creating status chart with data:', { approvedCount, pendingCount, rejectedCount });

    statusChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['مقبول', 'في الانتظار', 'مرفوض'],
        datasets: [{
          data: [approvedCount, pendingCount, rejectedCount],
          backgroundColor: [
            '#10B981', // Green
            '#F59E0B', // Yellow
            '#EF4444'  // Red
          ],
          borderWidth: 2,
          borderColor: '#FFFFFF',
          hoverOffset: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              padding: 15,
              usePointStyle: true,
              pointStyle: 'circle',
              font: {
                size: 12,
                family: 'Arial'
              }
            }
          },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleColor: '#FFFFFF',
            bodyColor: '#FFFFFF',
            cornerRadius: 8,
            displayColors: true
          }
        }
      }
    });
    
    console.log('Status chart created successfully');
  } catch (error) {
    console.error('Error creating status chart:', error);
  }
}

function createFieldChart() {
  try {
    if (!fieldChartRef.value) {
      console.log('Field chart ref not found');
      return;
    }

    const ctx = fieldChartRef.value.getContext('2d');
    if (!ctx) {
      console.log('Field chart context not available');
      return;
    }

    // Destroy existing chart
    if (fieldChart) {
      fieldChart.destroy();
    }

    const fieldData = Array.from(analyticsData.fieldStats.entries())
      .sort((a, b) => b[1] - a[1])
      .slice(0, 6);

    // Don't create chart if no data
    if (fieldData.length === 0) {
      console.log('No data for field chart, skipping creation');
      return;
    }

    console.log('Creating field chart with data:', fieldData);

    fieldChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: fieldData.map(([field]) => {
          const fieldName = getFieldName(field);
          return fieldName.length > 20 ? fieldName.substring(0, 20) + '...' : fieldName;
        }),
        datasets: [{
          label: 'عدد المشاركين',
          data: fieldData.map(([, count]) => count),
          backgroundColor: [
            '#3B82F6', // Blue
            '#10B981', // Green
            '#F59E0B', // Yellow
            '#EF4444', // Red
            '#8B5CF6', // Purple
            '#F97316'  // Orange
          ],
          borderRadius: 8,
          borderSkipped: false,
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleColor: '#FFFFFF',
            bodyColor: '#FFFFFF',
            cornerRadius: 8
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              font: {
                size: 11
              }
            },
            grid: {
              color: 'rgba(0, 0, 0, 0.1)'
            }
          },
          x: {
            ticks: {
              maxRotation: 45,
              font: {
                size: 10
              }
            },
            grid: {
              display: false
            }
          }
        }
      }
    });
    
    console.log('Field chart created successfully');
  } catch (error) {
    console.error('Error creating field chart:', error);
  }
}

function createTrendChart() {
  try {
    if (!trendChartRef.value) {
      console.log('Trend chart ref not found');
      return;
    }

    const ctx = trendChartRef.value.getContext('2d');
    if (!ctx) {
      console.log('Trend chart context not available');
      return;
    }

    // Destroy existing chart
    if (trendChart) {
      trendChart.destroy();
    }

    // Generate last 7 days data for better visibility
    const last7Days = Array.from({ length: 7 }, (_, i) => {
      const date = new Date();
      date.setDate(date.getDate() - (6 - i));
      return date.toISOString().split('T')[0];
    });

    const trendData = last7Days.map(date => 
      analyticsData.dailyRegistrations.get(date) || 0
    );

    // Don't create chart if no data (all zeros)
    const hasData = trendData.some(count => count > 0);
    if (!hasData) {
      console.log('No data for trend chart, skipping creation');
      return;
    }

    console.log('Creating trend chart with data:', { last7Days, trendData });

    trendChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: last7Days.map(date => {
          const d = new Date(date);
          const dayNames = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
          return dayNames[d.getDay()];
        }),
        datasets: [{
          label: 'التسجيلات اليومية',
          data: trendData,
          borderColor: '#8B5CF6',
          backgroundColor: 'rgba(139, 92, 246, 0.2)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#8B5CF6',
          pointBorderColor: '#FFFFFF',
          pointBorderWidth: 3,
          pointRadius: 6,
          pointHoverRadius: 8,
          pointHoverBorderWidth: 3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleColor: '#FFFFFF',
            bodyColor: '#FFFFFF',
            cornerRadius: 8,
            displayColors: true
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              font: {
                size: 11
              }
            },
            grid: {
              color: 'rgba(0, 0, 0, 0.1)'
            }
          },
          x: {
            ticks: {
              font: {
                size: 10
              }
            },
            grid: {
              display: false
            }
          }
        }
      }
    });
    
    console.log('Trend chart created successfully');
  } catch (error) {
    console.error('Error creating trend chart:', error);
  }
}

function initializeCharts() {
  console.log('Initializing charts...');
  
  // Wait for DOM to be ready
  nextTick(() => {
    setTimeout(() => {
      console.log('Creating charts after delay...');
      createStatusChart();
      createFieldChart(); 
      createTrendChart();
    }, 100);
  });
}

onMounted(async () => {
  console.log('Component mounted, loading data...');
  
  try {
    // Check if Chart.js is available
    if (!Chart) {
      console.error('Chart.js is not available');
      uiStore.showAlert('error', 'خطأ في تحميل مكتبة الرسوم البيانية');
      return;
    }
    
    // Initialize with empty data first
    updateAnalyticsData();
    
    // Wait a moment for DOM to be ready
    await nextTick();
    setTimeout(() => {
      initializeCharts();
    }, 500);
    
    // Load real data
    loadParticipants();
    loadStatistics();
    
  } catch (error) {
    console.error('Error in onMounted:', error);
    uiStore.showAlert('error', 'خطأ في تحميل لوحة التحكم');
  }
});

// Watch for filter changes with debounce for search
let debounceTimer: ReturnType<typeof setTimeout>;
watch(filters, (newFilters, oldFilters) => {
  // If only search changed, use debounce
  if (newFilters.search !== oldFilters?.search && 
      newFilters.status === oldFilters?.status &&
      newFilters.registration_type === oldFilters?.registration_type &&
      newFilters.field === oldFilters?.field) {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
      currentPage.value = 1;
      loadParticipants();
    }, 500);
  } else {
    // For other filters, immediate update
    clearTimeout(debounceTimer);
    currentPage.value = 1;
    loadParticipants();
  }
}, { deep: true });

async function loadParticipants() {
  // Prevent multiple simultaneous requests
  if (loading.value) return;
  
  loading.value = true;
  try {
    const params = {
      page: currentPage.value,
      per_page: perPage.value,
      ...filters
    };
    
    // Remove empty filter values
    Object.keys(params).forEach(key => {
      if (params[key] === '' || params[key] === null || params[key] === undefined) {
        delete params[key];
      }
    });
    
    const response = await apiService.getParticipants(params);
    if (response.success && response.data) {
      // Check if response has pagination structure
      const responseData = response.data as any;
      if (responseData && typeof responseData === 'object' && 'data' in responseData && Array.isArray(responseData.data)) {
        participants.value = responseData.data;
        totalParticipants.value = responseData.total || responseData.data.length;
      } else if (Array.isArray(response.data)) {
        // Fallback: direct array
        participants.value = response.data;
        totalParticipants.value = response.data.length;
      } else {
        participants.value = [];
        totalParticipants.value = 0;
      }
      
      // Update analytics data and charts
      updateAnalyticsData();
      
      // Recreate charts with new data
      setTimeout(() => {
        initializeCharts();
      }, 200);
    }
  } catch (error: any) {
    console.error('Load participants error:', error);
    uiStore.showAlert('error', 'فشل في تحميل المشاركين');
    // Don't clear participants on error to maintain UI state
  } finally {
    loading.value = false;
  }
}

async function loadStatistics() {
  try {
    const response = await apiService.getStatistics();
    if (response.success && response.data) {
      statistics.total_participants = response.data.total_participants || 0;
      statistics.approved_participants = response.data.approved_participants || 0;
      statistics.pending_participants = response.data.pending_participants || 0;
      statistics.rejected_participants = response.data.rejected_participants || 0;
      
      // Update charts when statistics change
      nextTick(() => {
        createStatusChart();
      });
    }
  } catch (error: any) {
    console.error('Failed to load statistics:', error);
  }
}

async function exportParticipants() {
  try {
    // Prepare filters for export
    const exportFilters = {
      ...(filters.status && { status: filters.status }),
      ...(filters.registration_type && { registration_type: filters.registration_type }),
      ...(filters.field && { field_of_interest: filters.field }),
      ...(filters.search && { search: filters.search })
    };

    const blob = await apiService.exportParticipantsToExcel(exportFilters);
    
    // Create download link
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    
    // Generate filename with current date
    const currentDate = new Date().toISOString().split('T')[0];
    link.download = `participants-${currentDate}.xlsx`;
    
    // Trigger download
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Clean up
    window.URL.revokeObjectURL(url);
    
    uiStore.showAlert('success', 'تم تصدير البيانات بنجاح');
  } catch (error: any) {
    console.error('Export error:', error);
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
    SmartMonitoring: 'المتابعة الذكية للخدمات والمرافق',
    InteractiveTourism: 'إثراء تجربة الزائر',
    SmartMobility: 'النقل الذكي والتنقل المستدام',
    DigitalHealthcare: 'الرعاية الصحية الرقمية',
    EnvironmentalTech: 'التقنية البيئية',
    SmartInfrastructure: 'البنى التحتية الذكية'
  };
  return fieldMap[field] || field;
}

function getRegistrationTypeName(registrationType: string) {
  const typeMap: Record<string, string> = {
    Individual: 'فردي',
    Team: 'فريق',
    Organization: 'منظمة'
  };
  return typeMap[registrationType] || registrationType;
}

function formatDate(date: string) {
  if (!date) return 'غير محدد';
  
  const dateObj = new Date(date);
  const now = new Date();
  const diffTime = Math.abs(now.getTime() - dateObj.getTime());
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  
  // If less than 7 days, show relative date
  if (diffDays === 1) return 'أمس';
  if (diffDays === 0) return 'اليوم';
  if (diffDays <= 7) return `منذ ${diffDays} أيام`;
  
  // Otherwise show formatted date
  return dateObj.toLocaleDateString('ar-SA', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
}

function previousPage() {
  if (currentPage.value > 1) {
    currentPage.value--;
    loadParticipants();
  }
}

function nextPage() {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
    loadParticipants();
  }
}

function handleLogout() {
  adminStore.logout();
  router.push('/admin/login');
}

async function downloadCv(id: number) {
  try {
    const blob = await apiService.downloadParticipantCv(id);
    
    // الحصول على معلومات الملف من المشارك المحدد
    const participant = selectedParticipant.value;
    const cvPath = participant?.cv_path || '';
    const extension = cvPath.split('.').pop() || 'pdf';
    const cleanName = participant?.full_name?.replace(/[^a-zA-Z0-9_\-\.]/g, '') || 'file';
    const filename = `cv-${cleanName}.${extension}`;
    
    const url = window.URL.createObjectURL(new Blob([blob]));
    const link = document.createElement('a');
    link.href = url;
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    link.remove();
    window.URL.revokeObjectURL(url);
  } catch (error) {
    uiStore.showAlert('error', 'فشل في تحميل المرفق');
  }
}

function openEvaluationModal(participant: Participant) {
  evaluationParticipant.value = participant;
  showEvaluationModal.value = true;
  // Reset form
  evaluationForm.score = 0;
  evaluationForm.description = '';
  evaluationErrors.score = '';
  evaluationErrors.description = '';
}

function closeEvaluationModal() {
  showEvaluationModal.value = false;
  evaluationParticipant.value = null;
}

function validateEvaluationForm(): boolean {
  let isValid = true;
  
  // Reset errors
  evaluationErrors.score = '';
  evaluationErrors.description = '';
  
  // Validate score
  if (!evaluationForm.score || evaluationForm.score < 0 || evaluationForm.score > 100) {
    evaluationErrors.score = 'يجب إدخال نسبة صحيحة من 1 إلى 100';
    isValid = false;
  }
  
  // Validate description
  if (!evaluationForm.description.trim() || evaluationForm.description.trim().length < 10) {
    evaluationErrors.description = 'يجب إدخال وصف لا يقل عن 10 أحرف';
    isValid = false;
  }
  
  return isValid;
}

async function submitEvaluation() {
  if (!validateEvaluationForm() || !evaluationParticipant.value) {
    return;
  }
  
  evaluationLoading.value = true;
  try {
    const response = await apiService.approveParticipant(evaluationParticipant.value.id, {
      score: evaluationForm.score,
      description: evaluationForm.description.trim()
    });
    
    if (response.success) {
      uiStore.showAlert('success', 'تم قبول المشارك وحفظ التحكيم بنجاح');
      closeEvaluationModal();
      loadParticipants();
      loadStatistics();
    }
  } catch (error: any) {
    uiStore.showAlert('error', 'فشل في قبول المشارك');
  } finally {
    evaluationLoading.value = false;
  }
}

async function rejectParticipant(participantId: number) {
  if (!confirm('هل أنت متأكد من رفض هذا المشارك؟')) {
    return;
  }
  
  try {
    const response = await apiService.rejectParticipant(participantId);
    if (response.success) {
      uiStore.showAlert('success', 'تم رفض المشارك');
      loadParticipants();
      loadStatistics();
    }
  } catch (error: any) {
    uiStore.showAlert('error', 'فشل في رفض المشارك');
  }
}
</script>

<style scoped>
.card {
  background: white;
  border-radius: 0.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  padding: 1.5rem;
}

/* Enhanced Analytics Styles */
.analytics-card {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 12px;
  padding: 1.5rem;
  transition: all 0.3s ease;
}

.analytics-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.chart-container {
  position: relative;
  width: 100%;
  height: 300px;
}

.kpi-card {
  position: relative;
  overflow: hidden;
}

.kpi-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
  pointer-events: none;
}

/* Gradient animations */
@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.gradient-animated {
  background-size: 200% 200%;
  animation: gradientShift 6s ease infinite;
}

/* Loading shimmer effect */
@keyframes shimmer {
  0% { background-position: -200px 0; }
  100% { background-position: calc(200px + 100%) 0; }
}

.loading-shimmer {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200px 100%;
  animation: shimmer 1.5s infinite;
}

/* Responsive chart styles */
@media (max-width: 768px) {
  .chart-container {
    height: 250px;
  }
}

/* Custom scrollbar for long lists */
.custom-scrollbar {
  scrollbar-width: thin;
  scrollbar-color: #CBD5E0 #F7FAFC;
}

.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: #F7FAFC;
  border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #CBD5E0;
  border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #A0AEC0;
}

/* Improved tooltip styles for charts */
.chart-tooltip {
  background: rgba(0, 0, 0, 0.8) !important;
  border: none !important;
  border-radius: 8px !important;
  padding: 12px !important;
  font-size: 14px !important;
  color: white !important;
}

/* Status badge animations */
.status-badge {
  position: relative;
  overflow: hidden;
}

.status-badge::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.6s;
}

.status-badge:hover::after {
  left: 100%;
}

/* Enhanced button styles */
.btn-analytics {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border: none;
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  font-weight: 600;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.btn-analytics:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.btn-analytics:active {
  transform: translateY(0);
}

/* City ranking styles */
.city-rank-1 { background: linear-gradient(135deg, #FFD700, #FFA500); }
.city-rank-2 { background: linear-gradient(135deg, #C0C0C0, #A8A8A8); }
.city-rank-3 { background: linear-gradient(135deg, #CD7F32, #A0522D); }
.city-rank-4 { background: linear-gradient(135deg, #3B82F6, #1E40AF); }
.city-rank-5 { background: linear-gradient(135deg, #8B5CF6, #6D28D9); }

/* Progress bar animations */
.progress-bar {
  transition: width 1s ease-in-out;
}

/* Responsive grid improvements */
@media (max-width: 1280px) {
  .xl\\:grid-cols-5 {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

@media (max-width: 1024px) {
  .xl\\:grid-cols-5,
  .xl\\:grid-cols-3 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (max-width: 640px) {
  .xl\\:grid-cols-5,
  .lg\\:grid-cols-2 {
    grid-template-columns: repeat(1, minmax(0, 1fr));
  }
}
</style> 