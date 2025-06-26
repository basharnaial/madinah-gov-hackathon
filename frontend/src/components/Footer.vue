<template>
  <footer class="bg-accent-1000  text-gray-700 pt-10 pb-6 mt-12 border-t-4 border-primary-600 shadow-inner">
    <div class="container-custom flex flex-col md:flex-row md:items-start justify-between gap-8">
      <!-- Title & Contact -->
      <div class="flex-1 mb-6 md:mb-0">
        <div class="text-2xl font-extrabold text-white mb-2 tracking-wide">برمجان المدينة</div>
        <div class="flex flex-col gap-1 text-sm">
          <div><span class="font-semibold text-accent-500">الهاتف:</span> <a href="tel:+966148155555" class="hover:underline text-white hover:text-accent-500 transition">014 815 5555 - آمر 199099</a></div>
          <div><span class="font-semibold text-accent-500">البريد الإلكتروني:</span> <a href="mailto:info@almadinah.gov.sa" class="hover:underline text-white hover:text-accent-500 transition">info@almadinah.gov.sa</a></div>
        </div>
      </div>
      <!-- Quick Links -->
      <div class="flex-1 flex flex-col gap-2 text-sm items-start md:items-end text-white">
        <a href="#" class="font-semibold hover:underline text-white hover:text-accent-500 transition">المقترحات والملاحظات</a>
        <a href="https://services.almadinah.gov.sa/Home/PrivacyPolicy" target="_blank" rel="noopener" class="hover:underline  hover:text-accent-500 transition">سياسة الخصوصية</a>
        <a href="https://services.almadinah.gov.sa/Home/UsagePolicy" target="_blank" rel="noopener" class="hover:underline  hover:text-accent-500 transition">سياسة الإستخدام</a>
      </div>
    </div>
    <div class="container-custom mt-8 border-t border-gray-200 pt-4 text-xs text-accent-500 text-center">
      &copy; {{ new Date().getFullYear() }} برمجان المدينة. جميع الحقوق محفوظة.
    </div>
  </footer>
</template>

<script setup lang="ts">
// No script needed
</script>

<style scoped>
footer {
  direction: inherit;
}
</style> 