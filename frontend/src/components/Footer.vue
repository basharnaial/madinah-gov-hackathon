<template>
  <footer class="bg-accent-500 text-secondary-500 py-8 mt-8">
    <div class="container-custom flex flex-col md:flex-row items-center md:items-start justify-between gap-6">
      <!-- Contact Info -->
      <div class="mb-4 md:mb-0">
        <div class="text-lg font-bold mb-2">برمجان المدينة</div>
        <div class="text-sm">Email: <a href="mailto:info@madinah-hackathon.com" class="underline hover:text-secondary-300">info@madinah-hackathon.com</a></div>
        <div class="text-sm">Phone: <a href="tel:+966500000000" class="underline hover:text-secondary-300">+966 50 000 0000</a></div>
      </div>
      <!-- Quick Links -->
      <div class="flex flex-col gap-2 text-sm">
        <a href="#" class="hover:underline">Terms</a>
        <a href="#" class="hover:underline">Privacy Policy</a>
      </div>
      <!-- Copyright -->
      <div class="text-xs text-secondary-300 mt-4 md:mt-0 text-center md:text-right">
        &copy; {{ new Date().getFullYear() }} Madinah Hackathon. All rights reserved.
      </div>
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